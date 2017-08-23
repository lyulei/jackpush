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
//Route::any('/code/{str}','IndexController@code');

Route::resource('code','CodeController');

Route::any('login','IndexController@Login');
Route::get('logout','IndexController@Logout');

/*
Route::get('/', function () {
    return view('welcome');
});*/
