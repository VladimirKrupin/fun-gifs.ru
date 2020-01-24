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
        'user_id', 'file_id', 'comment', 'status','slug','group'
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

}
