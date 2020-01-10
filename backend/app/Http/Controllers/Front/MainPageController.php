<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Models\Post\Post;
use App\Http\Models\Post\PostsTag;
use App\Http\Models\Tag\Tag;
use Illuminate\Http\Request;

class MainPageController extends Controller
{
    public $tags_colors = ['secondary','primary','info','success','warning','danger','rose','dark'];
    public function index()
    {
        return view('front.index',[
            'posts'=>Post::where('status', 1)->with('files')->orderBy('created_at', 'desc')->paginate(10),
            'tags'=>Tag::all()->toArray(),
            'colors'=>$this->tags_colors,
            'counter'=>0,
        ]);
    }

    public function tag($slug){
        $tag = Tag::where('slug',$slug)->first()->toArray();

        $posts_ids = PostsTag::where('tag_id', $tag['id'])->select('post_id')->get()->toArray();
        $ids = [];
        foreach ($posts_ids as $post){
            $ids[] = $post['post_id'];
        }
        $posts = Post::where('status', 1)->whereIn('id',$ids)->with('files')->orderBy('created_at', 'desc')->paginate(10);

        return view('front.index',[
            'posts'=>$posts,
            'tags'=>Tag::all()->toArray(),
            'colors'=>$this->tags_colors,
            'counter'=>0,
            'tag'=>$tag['name'],
        ]);
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