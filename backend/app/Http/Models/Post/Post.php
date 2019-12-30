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

//    public function getSlugAttribute()
//    {
////        var_dump(Str::slug($this->attributes['comment'], '-'));
////        $this->attributes['slug'] = Str::slug($this->attributes['comment'], '-');
//        return Str::slug($this->attributes['comment'], '-');
//    }

    public function getLinkAttribute()
    {
        return route('front.post', $this->slug);
    }


}
