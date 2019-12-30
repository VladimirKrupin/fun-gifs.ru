<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Models\Post\Post;
use Illuminate\Http\Request;

class SinglePostController extends Controller
{
    public function index($id)
    {
//        return view('front.post',['post'=>Post::where('status', 1)->with('files')->take(10)->orderBy('created_at', 'desc')->get()->toArray()]);
        return view('front.post',[
            'title' => $id,
        ]);
    }

}