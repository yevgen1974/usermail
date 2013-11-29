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
Route::get('users/login', array('as' => 'home', 'uses' => 'App\Controllers\UsersController@login'));
Route::get('users/logout', array('as' => 'logout','uses' => 'App\Controllers\UsersController@logout'));
Route::get('users/profile', array('as' => 'profile', 'uses' => 'App\Controllers\UsersController@profile'));
Route::get('users/activated', array('as' => 'activated', 'uses' => 'App\Controllers\UsersController@activated'));
Route::get('users/activation', array('as' => 'activation', 'uses' => 'App\Controllers\UsersController@activation'));
Route::get('users/captcha', function()
{
 $captcha = new Captcha;
 $cap = $captcha->create();
 return View::make('captcha')->with('cap', $cap);
});
