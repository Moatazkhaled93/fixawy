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
Route::post('register', 'API\UserController@register');
Route::post('login', 'API\UserController@login');
Route::get('ListOfOrders','API\OrdersController@ListOfOrders');
Route::post('customerOrder','API\OrdersController@customerOrder');
Route::post('reservedOfOrder','API\OrdersController@reservedOfOrder');
