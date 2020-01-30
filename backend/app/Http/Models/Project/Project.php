<?php

namespace App\Http\Models\Project;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name'
    ];

    public function group(){
        return $this->hasMany('App\Http\Models\Group\Group');
    }
}
