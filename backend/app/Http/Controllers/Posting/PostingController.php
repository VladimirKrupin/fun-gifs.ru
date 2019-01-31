<?php
namespace App\Http\Controllers\Posting;
use App\Http\Models\Post\Post;
use App\Http\Controllers\Controller;
use App;
use Validator;

class PostingController extends Controller
{

    public function posting(){
        $post = Post::where('status',0)
            ->with('files')
            ->first();
        if ($post){
            var_dump($post);
        }
    }

}