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

Route::controller('users', 'UsersController');
Route::get('users/forgot', array('as' => 'forgot', 'uses' => 'App\Controllers\UsersController@forgot'));
Route::get('users/forgot_sent', array('as' => 'forgot_sent', 'uses' => 'App\Controllers\UsersController@forgot_sent'));
Route::get('users/login', array('as' => 'login', 'uses' => 'App\Controllers\UsersController@login'));
Route::get('users/index', array('as' => 'index', 'uses' => 'App\Controllers\UsersController@index'));
Route::get('logout', array('as' => 'logout', function () { }))->before('auth');
Route::get('profile', array('as' => 'profile', function () { }))->before('auth');