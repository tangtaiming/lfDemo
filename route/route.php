<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

//Route::domain('www', 'public');

Route::get('think', function () {
    return 'hello,ThinkPHP5!';
});

//Route::get('hello/:name', 'index/hello');

Route::get('auth', 'api/jwt_login/auth');
Route::rule('hello/:name','index/hello')
    ->middleware('jwt_auth');
Route::rule('movie','api/movie/movieList')
    ->middleware('jwt_auth');
Route::rule('godformulas','api/godformula_controller/godformulas')
    ->middleware('jwt_auth');

Route::resource('blogs','index/blog');
Route::resource('learnCards','api/learn_card_controller');

return [

];
