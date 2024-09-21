<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        return view('back.categories.index', compact('categories'));
    }
    public function create(Request $request)
    {
        $isExist = Category::whereSlug(str_slug($request->category));
        if ($isExist) {
            toastr()->error('Kategori eklenemedi.');
            return redirect()->back();
        }
        $category = new Category;
        $category->name = $request->category;
        $category->slug = str_slug($request->category);
        $category->save();

        toastr()->success('Kategori başarıyla eklendi.');
        return redirect()->back();
    }
    public function update(Request $request)
    {
        $isExist = Category::whereSlug($request->slug)->where('id', 'not', $request->id)->first() || Category::whereName($request->category)->where('id', 'not', $request->id)->first();
        if ($isExist) {
            toastr()->error('Kategori güncellenmedi.');
            return redirect()->route('admin.category.index');
        }
        $category = Category::find($request->id);
        $category->name = $request->category;
        $category->slug = $request->slug;
        $category->save();

        toastr()->success('Kategori başarıyla eklendi.');
        return redirect()->route('admin.category.index');
    }

    public function switch(Request $request)
    {
            $category = Category::findOrFail($request->id);
            $category->status = !$category->status;
            $category->save();
    }
    public function delete(Request $request)
    {
        $category = Category::findOrFail($request->id);
        if ($category->id == 1) {
            toastr()->warning('Genel kategorisi silinemez.');
            return redirect()->route('admin.category.index');
        }
        if ($category->articleCount()) {
            Article::where('category_id', $category->id)->update(['category_id' => 1]);
        }
        $category->delete();
        toastr()->success('Kategori başarıyla silindi.');
        return redirect()->route('admin.category.index');
    }

    public function getData(Request $request)
    {
        $category = Category::findOrFail($request->id);
        return response()->json($category);
    }
}
