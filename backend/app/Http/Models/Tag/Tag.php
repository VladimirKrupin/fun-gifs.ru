<?php

namespace App\Http\Models\Tag;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','slug'
    ];

    protected $appends = ['link'];

    public function getLinkAttribute()
    {
        return route('front.tag', $this->slug);
    }

}
