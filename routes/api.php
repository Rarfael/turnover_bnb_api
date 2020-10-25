<?php
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
Route::apiResource('/products', 'ProductController');
Route::get('/filter/products', 'ProductController@getBetween');
Route::put('/mass-update/products', 'ProductController@massUpdate');
