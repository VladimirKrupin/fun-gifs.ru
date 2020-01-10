<?php

namespace App\Http\Models\Post;

use App\Http\Models\Tag\Tag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $appends = ['link'];

    protected $fillable = [
        'user_id', 'file_id', 'comment', 'status','slug'
    ];


    public function files()
    {
        return $this->hasMany('App\Http\Models\Post\File');
    }


    public function getLinkAttribute()
    {
        return route('front.post', $this->slug);
    }

    public function PostTag(){
        return $this->hasMany('App\Http\Models\Post\PostsTag');
    }

    public function tags(){
        $tags = [];
        $ids = [];
        foreach ($this->hasMany('App\Http\Models\Post\PostsTag')->with('tag')->get()->toArray() as $post_tag){
            $ids[] = $post_tag['tag']['id'];
        }
        foreach (Tag::where('id','>',0)->get()->toArray() as $tag){
            if (in_array($tag['id'], $ids)){
                $tags[] = [
                    'id'=>$tag['id'],
                    'name'=>$tag['name'],
                    'value'=>true,
                ];
            }else{
                $tags[] = [
                    'id'=>$tag['id'],
                    'name'=>$tag['name'],
                    'value'=>false,
                ];
            }
        }

        return $tags;
    }

}
