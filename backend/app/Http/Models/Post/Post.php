<?php

namespace App\Http\Models\Post;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'user_id', 'file_id', 'comment', 'status'
    ];


    public function projectScheme()
    {
        return $this->hasMany('App\Http\Models\Post\File');
    }

    
}
