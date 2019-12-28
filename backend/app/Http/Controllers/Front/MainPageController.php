<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Models\Post\Post;

class MainPageController extends Controller
{
    public function index()
    {
        return view('front.index',['posts'=>Post::where('status', 1)->with('files')->take(10)->orderBy('created_at', 'desc')->get()->toArray()]);
    }

    public function demo()
    {
        return view('front.demo');
    }
    public function siteMap()
    {

    }
}