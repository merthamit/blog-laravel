<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::orderBy('created_at', 'asc')->get();
        return view('back.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('back.articles.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'min:3',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $article = new Article;
        $article->title = $request->title;
        $article->category_id = $request->category;
        $article->content = $request->content;
        $article->slug = str_slug($request->title);

        if ($request->hasFile('image')) {
            $imageName = str_slug($request->title) . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'), $imageName);
            $article->image = 'uploads/' . $imageName;
        }

        $article->save();
        toastr()->success('Makale başarıyla oluşturuldu.');
        return redirect()->route('admin.makaleler.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function switch(Request $request)
    {
            $article = Article::findOrFail($request->id);
            $article->status = !$article->status;
            $article->save();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $categories = Category::all();
        $article = Article::findOrFail($id);
        return view('back.articles.edit', compact('categories', 'article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'min:3',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $article = Article::findOrFail($id);
        $article->title = $request->title;
        $article->category_id = $request->category;
        $article->content = $request->content;
        $article->slug = str_slug($request->title);

        if ($request->hasFile('image')) {
            $imageName = str_slug($request->title) . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'), $imageName);
            $article->image = 'uploads/' . $imageName;
        }

        $article->save();
        toastr()->success('Makale başarıyla güncellendi.');
        return redirect()->route('admin.makaleler.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    }
    public function trashed()
    {
        $articles = Article::onlyTrashed()->orderBy('deleted_at', 'desc')->get();
        return view('back.articles.trashed', compact('articles'));

    }
    public function recover($id)
    {
        Article::onlyTrashed()->find($id)->restore();
        toastr()->success('Makale başarıyla geri yüklendi.');
        return redirect()->route('admin.makaleler.index');

    }
    public function delete(string $id)
    {
        $article = Article::find($id);
        if (!$article) {
            toastr()->error('Makale silinemedi çünkü böyle bir şey yok.');
            return redirect()->route('admin.makaleler.index');
        }
        $article->delete();
        toastr()->success('Makale başarıyla silindi.');
        return redirect()->route('admin.makaleler.index');
    }
    public function hardDelete(string $id)
    {
        $article = Article::onlyTrashed()->find($id);
        if (!$article) {
            toastr()->error('Makale silinemedi çünkü böyle bir şey yok.');
            return redirect()->route('admin.makaleler.index');
        }

        if (File::exists($article->image)) {
            File::delete(public_path($article->image));
        }
        $article->forceDelete();
        toastr()->success('Makale başarıyla silindi.');
        return redirect()->route('admin.trashed.article');
    }
}
