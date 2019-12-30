<?php
Route::get('/oauthvk/', 'OAuths\OauthsController@OAuthVk');
Route::get('/', 'Front\MainPageController@index');
Route::get('/demo', 'Front\MainPageController@demo');
Route::get('/posts/{id}', 'Front\SinglePostController@index');
//Route::any('{all}', function (){return 'api.fun-gifs';})->where('all', '.*');