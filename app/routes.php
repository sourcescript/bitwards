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


Route::get('/login', 'BusinessAuthController@index');
Route::post('/login', 'BusinessAuthController@login');
Route::get('/register', 'BusinessAuthController@register');
Route::post('/register', 'BusinessAuthController@save');
Route::get('/logout', 'BusinessAuthController@logout');


Route::get('/dashboard', 'BusinessMainController@dashboard');

Route::get('/', function()
{
	return View::make('hello');
});
