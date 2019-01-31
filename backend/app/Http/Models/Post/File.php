<?php

namespace App\Http\Models\Post;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'path', 'post_id'
    ];
    
}
