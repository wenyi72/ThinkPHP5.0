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

// return [
//     '__pattern__' => [
//         'name' => '\w+',
//     ],
//     '[hello]'     => [
//         ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
//         ':name' => ['index/hello', ['method' => 'post']],
//     ],

// ];
//引入路由类
use think\Route;
//Route::get('page','admin/index/page');

//Route::get('/','admin/public/login');
Route::get('/','admin/index/index2');
Route::get('test','admin/test/test');
Route::get('db','admin/test/db');
Route::get('db2','admin/test/db2');
Route::get('db3','admin/test/db3');
Route::any('admin/public/login','admin/public/login');

Route::group('admin',function(){

    //展示登录模板的路由
    Route::get('/index/page','admin/index/page');
    Route::get('/index/index','admin/index/index');
    Route::get('/index/index2','admin/index/index2');
    Route::get('/index/top','admin/index/top');
    Route::get('/index/left','admin/index/left');
    Route::get('/index/main','admin/index/main');
    Route::get('/user/login','admin/user/login');
    Route::any('/public/login','admin/public/login');
    Route::get('/public/logout','admin/public/logout');
    Route::any('/category/add','admin/category/add');
    Route::any('/category/index','admin/category/index');
    Route::any('/category/upd','admin/category/upd');
    Route::get('/category/ajaxdel','admin/category/ajaxdel');
    Route::any('/article/add','admin/article/add');
    Route::any('/article/index','admin/article/index');
    Route::any('/article/upd','admin/article/upd');
    Route::any('/article/del','admin/article/del');
    Route::get('/article/ajaxGetContent','admin/article/ajaxGetContent');
    Route::get('/test/test','admin/test/test');
});