<?php

namespace App\Http\Models\Group;

use Illuminate\Database\Eloquent\Model;

class GroupsSettings extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'access_token', 'group_id','api_v','private_key','name','key_words','description'
    ];
    
}
