<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;



Route::get('customer/{page}', function () {


    return view('customer/layouts/master',['name' => 'James']);
})->name('customer');

Route::get('customer/{page}/{message}', function () {
    return view('customer/layouts/master');
});

Route::post('/customer-login', 'CustomerController@login');
Route::post('/customer-register', 'CustomerController@register');
Route::post('/customer/customer-logout', 'CustomerController@logout');
Route::post('/customer-session', 'CustomerController@sessionData');
Route::post('/home', 'CategoryController@index');
Route::post('/category_c/{id}', 'ProductController@index');

Route::post('/category_filter', 'ProductController@category_filter');
Route::post('/country_filter', 'ProductController@country_filter');
Route::post('/size_filter', 'ProductController@size_filter');
Route::post('/product_by_price/{id}', 'ProductController@product_by_price');
Route::post('/product-details/{id}', 'ProductController@getProductDetails');
Route::post('/featured-product', 'customer\CartController@getFeaturedProducts');
Route::post('/new-product', 'customer\CartController@getNewProducts');

Route::get('/add-cart/{id}/{cartQty}', 'customer\CartController@addToCart');
Route::post('/customer/shipping-info', 'OrderController@shippinginfo');
Route::post('/all-cart', 'customer\CartController@allCart');
Route::post('/delete-cart', 'customer\CartController@deleteCart');
Route::post('/update-cart', 'customer\CartController@updateCart');

Route::post('/customer/confirm-order', 'OrderController@pay');
