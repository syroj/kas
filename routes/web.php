<?php

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
Route::get('/filter','dataController@filter');
Route::post('/addCategory','categoryController@add');
Route::get('/kategori/{id}','dataController@byCategory');
Route::get('export','dataController@export');