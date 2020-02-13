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

Route::get('/shop', 'FrontendController@shop');
Route::get('/shop/{kategori}', 'FrontendController@kategorishop');

Route::get('/produk/{produk}', function () {
    return view('frontend.product');
});

Route::get('/cart', 'Ecommerce\CartController@cart');
Route::get('/getsubtotal', 'Ecommerce\CartController@subtotal');
Route::get('/totalproduk', 'Ecommerce\CartController@totalproduk');

Route::get('/frontlogin', function () {
    return view('frontend.login');
});

Route::post('/formcart', 'Ecommerce\CartController@addToCart');
Route::post('/formcart-update', 'Ecommerce\CartController@updateCart');

Route::group(['prefix' => '/', 'middleware' => ['auth']], function () {
    Route::get('/checkout', function () {
        return view('frontend.checkout');
    });
});

Route::group(['prefix' => '/admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index');

    Route::get('/user', 'UserController@index');
    Route::post('/user-store', 'UserController@store');
    Route::delete('/user-destroy/{id}', 'UserController@destroy');

    Route::get('/customer', 'CustomerController@index');
    Route::post('/customer-store', 'CustomerController@store');
    Route::get('/customer/{id}/edit', 'CustomerController@edit');
    Route::delete('/customer-destroy/{id}', 'CustomerController@destroy');

    Route::get('/kategori', 'KategoriController@index');
    Route::post('/kategori-store', 'KategoriController@store');
    Route::get('/kategori/{id}/edit', 'KategoriController@edit');
    Route::delete('/kategori-destroy/{id}', 'KategoriController@destroy');

    Route::get('/produk', 'ProdukController@index');
    Route::post('/produk-store', 'ProdukController@store');
    Route::get('/produk/{id}/edit', 'ProdukController@edit');
    Route::delete('/produk-destroy/{id}', 'ProdukController@destroy');

    Route::get('/stokmasuk', 'StokmasukController@index');
    Route::post('/stokmasuk-store', 'StokmasukController@store');
    Route::get('/stokmasuk/{id}/edit', 'StokmasukController@edit');
    Route::delete('/stokmasuk-destroy/{id}', 'StokmasukController@destroy');

    Route::get('/order', 'OrderController@index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
