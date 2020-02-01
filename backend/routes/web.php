<?php

use App\Http\Models\Post\Post;

Route::get('/oauthvk/', 'OAuths\OauthsController@OAuthVk');
Route::get('/', 'Front\MainPageController@index');
Route::get('/tags/{slug}', 'Front\MainPageController@tag')->name('front.tag');
Route::get('/demo', 'Front\MainPageController@demo');
Route::get('/post/{slug}', 'Front\SinglePostController@index')->name('front.post');

Route::get('/moregirls', 'Front\MainPageController@moregirls');
Route::get('/moregirls/{slug}', 'Front\SinglePostController@moregirls')->name('front.moregirls');

Route::get('sitemap.xml', 'Front\MainPageController@siteMap');
//Route::any('{all}', function (){return 'api.fun-gifs';})->where('all', '.*');