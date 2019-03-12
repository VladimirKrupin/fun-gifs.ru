<?php

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
