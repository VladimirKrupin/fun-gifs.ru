<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Models\Post\Post;
use Illuminate\Http\Request;

class SinglePostController extends Controller
{
    public function index($slug)
    {
        $post = Post::where('slug',$slug)->with('files')->first()->toArray();

        return view('front.post', compact(['post']));
    }

}