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

Route::get('/', function()
{
	return View::make('hello');
});


Route::get('/',array('uses'=>'UserController@update','before'=>'auth'));
Route::get('/login',array('uses'=>'AuthController@login','before'=>'guest'));
Route::get('/logout',array('uses'=>'AuthController@logout','before'=>'auth'));
Route::post('/login',array('uses'=>'AuthController@authenticate','before'=>'guest'));

Route::get('/register',array('uses'=>'AuthController@register','before'=>'guest'));
Route::post('/register',array('uses'=>'AuthController@registerPost','before'=>'guest'));

Route::get('/update',array('uses'=>'UserController@update','before'=>'auth'));
Route::post('/update',array('uses'=>'UserController@updatePost','before'=>'auth'));

Route::get('/deleteImage',array('uses'=>'UserController@deleteImg','before'=>'auth'));
Route::post('/deleteImage',array('uses'=>'UserController@deleteImgPost','before'=>'auth'));

