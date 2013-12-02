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
Route::post('users/forgot', array('as' => 'forgot', 'uses' => 'App\Controllers\UsersController@forgot'));
Route::post('users/password', array('as' => 'password', 'uses' => 'App\Controllers\UsersController@password'));
Route::get('users/reset', array('as' => 'reset', 'uses' => 'App\Controllers\UsersController@reset'));
Route::get('users/login', array('as' => 'home', 'uses' => 'App\Controllers\UsersController@login'));
Route::get('users/logout', array('as' => 'logout','uses' => 'App\Controllers\UsersController@logout'));
Route::get('users/profile', array('as' => 'profile', 'uses' => 'App\Controllers\UsersController@profile'));
Route::get('users/activated', array('as' => 'activated', 'uses' => 'App\Controllers\UsersController@activated'));
Route::get('users/edit', array('as' => 'edit', 'uses' => 'App\Controllers\UsersController@edit'));
Route::get('users/captcha', function()
{
 $captcha = new Captcha;
 $cap = $captcha->create();
 return View::make('captcha')->with('cap', $cap);
});
