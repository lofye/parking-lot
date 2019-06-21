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

Route::get('/', 'HomeController');
Route::get('/enter', 'EnterController@index');
Route::get('/exit', 'ExitController@index');
Route::get('/exit/{ticket}', 'ExitController@show');
Route::post('/exit/{ticket}', 'ExitController@store');
