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

//Route::get('/s', function()
//{
//	return View::make('hello');
//});
Route::get('/test', 'AccountController@test');
Route::get('/test2', 'AccountController@test2');
Route::get('/', 'HomeController@index');
Route::get('/register', 'AccountController@register');
Route::post('/register_action', 'AccountController@register_action');
Route::post('/activate', [ 'as' => 'activate', 'uses' => 'AccountController@activate']);
Route::get('/mypart', 'HomeController@mypart');
Route::get('/create', 'HomeController@create');
Route::post('/create_action', 'HomeController@create_action');
Route::post('/login_action', 'AccountController@login_action');
Route::get('/logout', 'AccountController@logout_action');
Route::get('/tag/{tag}', 'HomeController@tag');
Route::get('/edit/{id}', 'HomeController@edit');
Route::post('/edit_action', 'HomeController@edit_action');
Route::get('/delete_action/{id}', 'HomeController@delete_action');
Route::get('/random', 'HomeController@random');
Route::get('/profile', 'AccountController@profile');
Route::post('/profile_action', 'AccountController@profile_action');