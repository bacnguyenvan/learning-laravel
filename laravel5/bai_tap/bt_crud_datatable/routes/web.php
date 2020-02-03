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

// Route::get('/', function () {
//     return view('welcome');
// });




// group
Route::get('mapping-master/list','MappingController@list')->name('mapping-list');
Route::match(['get','post'],'mapping-master/new','MappingController@new')->name('mapping-new');
Route::match(['get','post'],'mapping-master/edit/{id}','MappingController@edit')->name('mapping_edit');
Route::get('mapping-master/delete/{id}','MappingController@delete')->name('mapping_delete');

//machine
// Route::get('machine/list','MachineController@list')->name('machine-list');
Route::match(['get','post'],'machine/list','MachineController@list')->name('machine-list');
Route::match(['get','post'],'machine/new','MachineController@new');
Route::match(['get','post'],'machine/edit/{id}','MachineController@edit')->name('machine_edit');
Route::match(['get','post'],'machine/delete','MachineController@delete')->name('machine_delete');

