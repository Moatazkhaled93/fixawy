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
Route::post('register', 'API\UserController@register');
Route::post('login', 'API\UserController@login');
Route::get('ListOfOrders','API\OrdersController@ListOfOrders')->middleware('auth:api');
Route::post('customerOrder','API\OrdersController@customerOrder')->middleware('auth:api');
Route::post('reservedOfOrder','API\OrdersController@reservedOfOrder')->middleware('auth:api');




