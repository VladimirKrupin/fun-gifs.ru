<?php

use App\Http\Models\Post\Post;

Route::get('/oauthvk/', 'OAuths\OauthsController@OAuthVk');
Route::get('/', 'Front\MainPageController@index');
Route::get('/demo', 'Front\MainPageController@demo');
Route::get('/post/{slug}', 'Front\SinglePostController@index')->name('front.post');
Route::get('/posts', function () {
    return view('front.posts', ['posts'=>Post::where('status', 1)->with('files')->orderBy('created_at', 'desc')->get()->toArray()]);
});
Route::get('sitemap.xml', 'Front\MainPageController@siteMap');
//Route::any('{all}', function (){return 'api.fun-gifs';})->where('all', '.*');