<?php

use App\Http\Models\Project\Project;
use App\Http\Models\Tag\Tag;
use App\Http\Models\User\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//USER CONTROLLER REQUESTS
Route::post('/login/', 'User\UserController@login');
Route::post('/putFiles/', 'Files\FilesController@putFiles')->middleware('auth:api');
Route::get('/getPosts/', 'Files\FilesController@getPosts')->middleware('auth:api');
Route::get('/createUser/', 'User\UserController@createUser');

Route::get('/getUserData/',
    function ()
    {
        return User::where('id',Auth::user()['id'])->first()->toArray();
    }
)->middleware('auth:api');

Route::get('/getProjects/',
    function ()
    {
        return Project::with(['group'=>function($q){$q->with('settings');}])->get()->toArray();
    }
)->middleware('auth:api');

Route::get('/tags/', function (){return Tag::all()->toArray();});
Route::post('/changeTag/', 'Files\FilesController@changeTag')->middleware('auth:api');

Route::post('/postingPost/', 'Posting\PostingController@postingPost')->middleware('auth:api');
Route::post('/removePost/', 'Posting\PostingController@removePost')->middleware('auth:api');
