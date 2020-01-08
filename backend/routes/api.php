<?php

use App\Http\Models\Tag\Tag;
use Illuminate\Http\Request;

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
Route::get('/tags/', Tag::all()->toArray());

Route::post('/postingPost/', 'Posting\PostingController@postingPost')->middleware('auth:api');
Route::post('/removePost/', 'Posting\PostingController@removePost')->middleware('auth:api');
