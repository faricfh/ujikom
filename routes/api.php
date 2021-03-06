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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', 'Api\FrontendController@index');
Route::get('/shop', 'Api\FrontendController@shop');
Route::get('/shop/{kategori}', 'Api\FrontendController@kategorishop');
Route::get('/produk/{produk}', 'Api\FrontendController@produkdetail');
Route::get('/cari', 'Api\FrontendController@cariproduk');
