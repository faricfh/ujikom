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
    return view('frontend.index');
});

Route::get('/shop', function () {
    return view('frontend.shop');
});
Route::get('/shop/{kategori}', function () {
    return view('frontend.shop');
});
Route::get('/produk/{produk}', function () {
    return view('frontend.product');
});

Route::get('/cart', function () {
    return view('frontend.cart');
});
Route::get('/cart', function () {
    return view('frontend.cart');
});
Route::get('/checkout', function () {
    return view('frontend.checkout');
});

Route::group(['prefix' => '/admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index');

    Route::get('/user', 'UserController@index');

    Route::get('/kategori', 'KategoriController@index');
    Route::post('/kategori-store', 'KategoriController@store');
    Route::get('/kategori/{id}/edit', 'KategoriController@edit');
    Route::delete('/kategori-destroy/{id}', 'KategoriController@destroy');

    Route::get('/produk', 'ProdukController@index');
    Route::post('/produk-store', 'ProdukController@store');
    Route::get('/produk/{id}/edit', 'ProdukController@edit');
    Route::delete('/produk-destroy/{id}', 'ProdukController@destroy');

    Route::get('/order', 'OrderController@index');

    Route::get('/transaksi', 'TransaksiController@index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
