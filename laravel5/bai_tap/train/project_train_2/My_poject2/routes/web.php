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
    return view('welcome');
});

// Route::get('managerUser',function(){
// 	return view('tableUser');
// });

Route::get('managerUser','myController@getAdd')->name('getAdd');
Route::post('managerUser','myController@postAdd')->name('postAdd');

