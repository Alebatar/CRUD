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

Route::get('/', array('as'=>'home','uses'=>'CrudController@index'));

Route::post('create', array('as' => 'add', 'uses'=>'CrudController@create'));

Route::get('update/{id}', array('as' => 'update', 'uses'=>'CrudController@update'))->where('id', '[0-9]+');

Route::get('delete/{id}', array('as' => 'delete', 'uses'=>'CrudController@delete'))->where('id', '[0-9]+');

Route::post('validateUpdate', array('as' => 'validateUpdate', 'uses'=>'CrudController@validateUpdate'));

Route::get('welcome', function () {
    return view('welcome');
});
