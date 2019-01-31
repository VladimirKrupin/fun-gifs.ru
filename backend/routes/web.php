<?php
Route::any('{all}', function (){return 'api.fun-gifs';})->where('all', '.*');