<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', function () {
    return view('crud');
});


Route::get('/create', function(){
	return view('create');
});

Route::post('/create/people', 'CrudController@write');

Route::get('/read', function(){
	return view('read');
});

Route::get('/update', function(){
	return view('update');
});

Route::get('/update/{id}', function($id){
	return view('updateDB')->with('id', $id);
});

Route::post('/updateDB/{id}', ['uses' => 'CrudController@update']);

Route::post('/alterUrl', function(){
	return redirect('update/'. $_POST['abang']);
});

Route::post('/alterUrlDelete', function(){
	return redirect('delete/'. $_POST['abang2']);
});

Route::post('/alterUrlRead', function(){
	return redirect('/read/'. $_POST['typeSearch']. '?q='. $_POST['q']);
});

Route::get('/read/{type}', ['uses' =>'CrudController@search']);

Route::get('/delete/{id}', ['uses' => 'CrudController@delete']); 
