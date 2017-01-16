<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
	if(Auth()->check()){
		return redirect('/home');
	}
    return view('auth.login');
});

Auth::routes();

Route::get('/home','dataController@index');
Route::get('/database','dataController@data');
Route::post('/in','dataController@in');
Route::post('/keluar','dataController@out');
Route::get('/search','dataController@search');
Route::get('/detail/{id}','dataController@detail');
Route::get('/filterDate','dataController@filter');

