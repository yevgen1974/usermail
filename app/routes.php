<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//Route::get('/', function()
//{
	//return View::make('hello');
//});

Route::controller('users', 'UsersController');
Route::get('users/forgot', array('as' => 'users.forgot', 'uses' => 'App\Controllers\UsersController@forgot'));
Route::get('users/forgot_sent', array('as' => 'users.forgot_sent', 'uses' => 'App\Controllers\UsersController@forgot_sent'));
Route::get('users/login', array('as' => 'users.login', 'uses' => 'App\Controllers\UsersController@login'));

//Route::get('register', 'UsersController@register');
//Route::get('home', 'UsersController@home');