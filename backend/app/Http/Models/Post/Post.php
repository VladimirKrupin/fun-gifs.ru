<?php

namespace App\Http\Models\Post;

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
        foreach ($this->hasMany('App\Http\Models\Post\PostsTag')->with('tag')->get()->toArray() as $tag){
            var_dump($tag['tag']['name']);
        }
        return $this->hasMany('App\Http\Models\Post\PostsTag');
    }

}
