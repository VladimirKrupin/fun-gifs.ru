<?php

namespace App\Http\Models\Group;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name', 'type'
    ];

    public function settings(){
        return $this->hasOne('App\Http\Models\Group\GroupsSettings');
    }
}
