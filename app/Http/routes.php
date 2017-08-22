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
// 认证路由...
//Route::get('auth/login', 'Auth\AuthController@getLogin');
//Route::post('auth/login', 'Auth\AuthController@postLogin');
//Route::get('auth/logout', 'Auth\AuthController@getLogout');

//Route::any('admin/login','Admin\AdminController@Login');
//Route::post('admin/login','Admin\AdminController@postLogin');
//Route::get('admin/logout','Admin\AdminController@postLogout');

Route::any('login','IndexController@Login');
Route::any('logout','IndexController@Logout');

/*
Route::get('/', function () {
    return view('welcome');
});*/
