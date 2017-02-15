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
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index');

Route::get('/usuarios', ['as'=>'user.index','uses' =>'UserController@index']);
Route::get('/usuarios/destroy/{id}', ['as'=>'user.destroy','uses' =>'UserController@destroy']);
Route::get('/usuarios/form/{id?}', ['as'=>'user.form','uses' =>'UserController@create']);
Route::post('/usuarios/form/{id?}', ['as'=>'user.edit','uses' =>'UserController@create']);


Route::group(['prefix'=>'api','middleware' => 'cors'], function($router) {
    Route::post('usuarios', ['uses'=>'ApiUserController@create']);
    Route::get('usuarios', ['uses'=>'ApiUserController@index']);
    Route::post('usuarios/delete/{id}', ['uses'=>'ApiUserController@destroy']);
    Route::post('usuarios/update', ['uses'=>'ApiUserController@update']);
    //Route::resource('/api/usuarios', 'ApiUserController');
});

Route::get('/clientes', 'ClientesController@index');
