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

Route::get('/search', 'FrontendController@search')->name('search');
Route::get('/cari', 'FrontendController@cariproduk')->name('cariproduk');

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

Route::post('/customerlogin', 'Ecommerce\LoginController@login');
Route::post('/customerregister', 'Ecommerce\LoginController@register');

Route::group(['middleware' => 'customer'], function () {
    Route::get('/dashboard', 'FrontendController@dashboard');
    Route::get('/checkout', 'Ecommerce\LoginController@checkout');
    Route::get('/logout', 'Ecommerce\LoginController@logout');
    Route::get('/provinsi/{id}/kota', 'Ecommerce\LoginController@getKota');
    Route::post('/test-submit', 'Ecommerce\LoginController@submit');


    // -------------------------------------------------------------------------------------------------------- //
    // Route::get('/', 'DonationController@index')->name('welcome');
    Route::post('/finish', function () {
        return redirect()->route('welcome');
    })->name('order.finish');

    Route::post('/order-store', 'TransaksiController@submitOrder')->name('order.store');
    Route::post('/notification/handler', 'TransaksiController@notificationHandler')->name('notification.handler');
    // -------------------------------------------------------------------------------------------------------- //
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
    Route::get('/stokmasuk-to-pdf', ['as' => 'HtmlToPDF', 'uses' => 'StokmasukController@HtmlToPDF']);

    Route::get('/stokkeluar', 'StokkeluarController@index');
    Route::post('/stokkeluar-store', 'StokkeluarController@store');
    Route::get('/stokkeluar/{id}/edit', 'StokkeluarController@edit');
    Route::delete('/stokkeluar-destroy/{id}', 'StokkeluarController@destroy');
    Route::get('/stokkeluar-to-pdf', ['as' => 'HtmlToPDF', 'uses' => 'StokkeluarController@HtmlToPDF']);

    Route::get('/order', 'OrderController@index');
    Route::get('/order/{id}/show', 'OrderController@show');
    Route::get('/order/{id}/edit', 'OrderController@show');
    Route::delete('/order-destroy/{id}', 'OrderController@destroy');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
