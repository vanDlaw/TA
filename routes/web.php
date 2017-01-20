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

Route::post('user/daftar', 'UserController@daftar');
Route::post('user/lokasi', 'UserController@lokasi');
Route::post('user/token', 'UserController@token');
Route::get('user/get/{pin}', 'UserController@getPos');
