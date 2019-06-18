<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/tickets', 'Api/TicketsController@store');
Route::get('/tickets/{ticket}', 'Api/TicketsController@show');

Route::post('/payments/{ticket}', 'Api/PaymentsController@store');