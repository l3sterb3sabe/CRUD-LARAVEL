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



Route::get('/crud', function () {
    return view('crud')->with('query', 'select * from people');
});

Route::get('login', function(){
	return view('login');
});

Route::post('loginNow', 'CrudController@login');

Route::get('/read', function () {
    return view('read');
});


Route::post('/create/people', 'CrudController@write');


Route::get('/update/{id}', 'CrudController@updateDB');
	

Route::get('/updateDB/{id}/{name}/{age}/{address}', ['uses' => 'CrudController@update']);

Route::post('/alterUrl', function(){

	echo $_POST['_dataId'];

	if($_POST['_btnType'] == 'update'){
		return redirect('updateDB/' . $_POST['_dataId'] . '/' .$_POST['_updateName']. '/' . $_POST['_updateAge'] . '/' . $_POST['_updateAddress']);
	}
		
	else if($_POST['_btnType'] == 'delete')
		return redirect('delete/'.$_POST['_dataId']);

});


Route::get('/read/{type}', ['uses' =>'CrudController@search']);

Route::get('/delete/{id}', ['uses' => 'CrudController@delete']); 

Route::get('/search', 'CrudController@search');

// Route::get('/test', function(){
// 	return view('test');
// });