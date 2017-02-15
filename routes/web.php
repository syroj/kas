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
Route::get('clear-db','dataController@truncate');
Route::get('/kwitansi/{id}','dataController@kwitansi');

// versi 2.0
Route::post('/jurnal_masuk','jurnalController@jurnal_masuk');
Route::post('/jurnal_keluar','jurnalController@jurnal_keluar');
Route::post('/addclient','jurnalController@addclient');
