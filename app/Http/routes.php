<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/','IndexController@index');
//Route::any('info','IndexController@info');
Route::any('password','IndexController@password');

//test
Route::any('test','IndexController@test');

Route::resource('code','CodeController');
Route::resource('create','CodeController');

/* 代码类型
 * */
Route::resource('CodeType','CodeTypeController');
/* 代码分类
 * */
Route::resource('CodeSpecies','CodeSpeciesController');
/* 代码分类-代码配置
 * */
Route::resource('CodeConfig','CodeConfigController');
/* 代码信息
 * */
Route::resource('CodeInfo','CodeInfoController');
/* 登录登出
 * */
Route::any('login','IndexController@Login');
Route::get('logout','IndexController@Logout');

/*
Route::get('/', function () {
    return view('welcome');
});*/
