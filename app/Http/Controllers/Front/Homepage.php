<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Config;
use App\Models\Contact;
use App\Models\Page;
use Illuminate\Http\Request;
use Validator;

class Homepage extends Controller
{
    public function __construct()
    {
        $config = Config::first();
        if ($config->active != 1) {
            redirect()->to('site-offline')->send();
        }
        $pages = Page::orderBy('order', 'asc')->get();
        $categories = Category::inRandomOrder()->whereStatus(1)->get();
        view()->share('pages', $pages);
        view()->share('categories', $categories);
    }
    public function index()
    {
        $data['categories'] = Category::inRandomOrder()->get();
        $data['articles'] = Article::orderBy('created_at', 'DESC')->with('getCategory')->whereHas('getCategory', function ($query) {
            $query->where('status', 1);
        })->whereStatus(1)->paginate(2)->withPath(url('/sayfa'));
        return view('front.homepage', $data);
    }

    public function single($category, $slug)
    {
        $category = Category::whereSlug($category)->first() ?? abort(403, 'Böyle bir kategori yok.');
        $article = Article::where('slug', $slug)->where('category_id', $category->id)->first() ?? abort(404, 'Böyle bir yazı bulunamadı.');
        $article->increment('hit');

        return view('front.single', compact('article', 'category'));
    }
    public function category($slug)
    {
        $category = Category::whereSlug($slug)->first() ?? abort(403, 'Böyle bir kategori yok.');
        $articles = Article::where('category_id', $category->id)->whereStatus(1)->orderBy('created_at', 'DESC')->paginate(1);

        return view('front.category', compact('category', 'articles', 'category'));
    }

    public function page($slug)
    {
        $page = Page::where('slug', $slug)->first() ?? abort(403, 'Böyle bir sayfa yok ama ileride olabilir.');
        return view('front.page', compact('page'));
    }

    public function contact()
    {

        return view('front.contact');
    }

    public function contactpost(Request $request)
    {
        $rules = [
            'name' => 'required|min:5',
            'topic' => 'required|min:5',
            'email' => 'required|email',
            'message' => 'required|min:10',
        ];

        $validate = Validator::make($request->post(), $rules);

        if ($validate->fails()) {
            return redirect()->route('contact')->withErrors($validate)->withInput();
        }

        $contact = new Contact;
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->topic = $request->topic;
        $contact->message = $request->message;
        $contact->save();
        return redirect()->route('contact')->with('success', 'Başarılı bir şekilde yollandı.');
    }
}
