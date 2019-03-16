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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::middleware(['auth'])->group(function () {

	Route::get('/', 'TodoController@index');
	Route::post('/store', 'TodoController@store')->name('store');
	Route::get('/edit{id}', 'TodoController@edit')->name('edit');
	Route::get('/remove{id}', 'TodoController@remove')->name('remove');
	Route::post('/update{id}', 'TodoController@update')->name('update');
	Route::get('/updateStatus{id}', 'TodoController@updateStatus')->name('updateStatus');
	Route::post('/sendInvitation', 'TodoController@sendInvitation')->name('sendInvitation');
	Route::get('/rejectInvitation{id}', 'TodoController@rejectInvitation')->name('rejectInvitation');
	Route::get('/acceptInvitation{id}', 'TodoController@acceptInvitation')->name('acceptInvitation');
	Route::get('/deleteWorker{id}', 'TodoController@deleteWorker')->name('deleteWorker');


	
    
});



Auth::routes();

