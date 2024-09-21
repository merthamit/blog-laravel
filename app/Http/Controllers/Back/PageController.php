<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PageController extends Controller
{

    public function index()
    {
        $pages = Page::orderBy('order', 'asc')->get();
        return view('back.pages.index', compact('pages'));
    }

    public function switch(Request $request)
    {
            $article = Page::findOrFail($request->id);
            $article->status = !$article->status;
            $article->save();
    }

    public function edit(string $id)
    {
        $page = Page::findOrFail($id);
        return view('back.pages.edit', compact('page'));
    }

    public function create()
    {
        $pages = Page::all();
        return view('back.pages.create', compact('pages'));
    }
    public function orders(Request $request)
    {
        foreach ($request->get('page') as $key => $order) {
            Page::where('id', $order)->update(['order' => $key]);
        }
    }

    public function delete(string $id)
    {
        $page = Page::find($id);
        if (!$page) {
            toastr()->error('Sayfa silinemedi çünkü böyle bir şey yok.');
            return redirect()->route('admin.page.index');
        }
        if (File::exists($page->images)) {
            File::delete(public_path($page->images));
        }
        $page->delete();
        toastr()->success('Sayfa başarıyla silindi.');
        return redirect()->route('admin.page.index');
    }

    public function createPost(Request $request)
    {
        $request->validate([
            'title' => 'min:3',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $pages = new Page;
        $pages->title = $request->title;
        $pages->content = $request->content;
        $pages->slug = str_slug($request->title);

        $lastOrder = Page::latest('order')->value('order');
        $pages->order = $lastOrder ? $lastOrder + 1 : 1;

        if ($request->hasFile('image')) {
            $imageName = str_slug($request->title) . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'), $imageName);
            $pages->images = 'uploads/' . $imageName;
        }

        $pages->save();
        toastr()->success('Sayfa başarıyla oluşturuldu.');
        return redirect()->route('admin.page.index');
    }
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'min:3',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $pages = Page::findOrFail($id);
        $pages->title = $request->title;
        $pages->content = $request->content;
        $pages->slug = str_slug($request->title);

        $lastOrder = Page::latest('order')->value('order');
        $pages->order = $lastOrder ? $lastOrder + 1 : 1;

        if ($request->hasFile('image')) {
            $imageName = str_slug($request->title) . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'), $imageName);
            $pages->images = 'uploads/' . $imageName;
        }

        $pages->save();
        toastr()->success('Makale başarıyla oluşturuldu.');
        return redirect()->route('admin.page.index');
    }
}
