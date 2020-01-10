<?php

namespace App\Http\Models\Post;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PostsTag extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $appends = ['tags'];

    protected $fillable = [
        'post_id', 'tag_id'
    ];

    public function tag(){
        return $this->hasOne('App\Http\Models\Tag\Tag','id','tag_id');
    }

    public function post(){
        return $this->belongsTo('App\Http\Models\Post\Post');
    }

    public function getTagsAttribute($value)
    {
        var_dump($value);
        return 'test';
    }
}
