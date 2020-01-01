<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Models\Post\Post;

class MainPageController extends Controller
{
    public function index()
    {
//        return view('front.index',['posts'=>Post::where('status', 1)->with('files')->take(10)->orderBy('created_at', 'desc')->get()->toArray()]);
        return view('front.index',['posts'=>Post::where('status', 1)->with('files')->orderBy('created_at', 'desc')->paginate(10)]);
    }

    public function demo()
    {
        return view('front.demo');
    }
    public function siteMap()
    {
        $posts = Post::where('status', 1)->with('files')->orderBy('created_at', 'desc')->get();
        return view('sitemap')->with(compact('posts'));
    }
}