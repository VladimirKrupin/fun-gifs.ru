<?php
Route::get('/oauthvk/', 'OAuths\OauthsController@OAuthVk');
Route::get('/',function (){return 'main';});
//Route::any('{all}', function (){return 'api.fun-gifs';})->where('all', '.*');