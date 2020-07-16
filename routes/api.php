<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('customers', 'ApiController@index');
Route::get('customers/{id}', 'ApiController@show');
Route::post('customers', 'ApiController@store');
Route::put('customers/{id}', 'ApiController@update');
Route::delete('customers/{id}','ApiController@destroy');
