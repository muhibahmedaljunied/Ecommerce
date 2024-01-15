<?php


use Illuminate\Support\Facades\Route;


use Illuminate\Support\Facades\Auth;


Route::get('customer/{page}', function () {
    return view('customer/layouts/master', ['name' => 'James']);
})->name('customer');

Route::get('customer/{page}/{message}', function () {
    return view('customer/layouts/master');
});

Route::post('/home', 'CategoryController@index');
Route::post('/category_c/{id}', 'ProductController@show');

// Route::group(['prefix' => 'cart'], function () {

Route::post('/featured-product', 'Customer\ProductController@getFeaturedProducts');
Route::post('/new-product', 'Customer\ProductController@getNewProducts');
Route::get('/add-cart/{id}/{cartQty}', 'Customer\CartController@addToCart');
Route::post('/all-cart', 'Customer\CartController@allCart');
Route::post('/delete-cart', 'Customer\CartController@deleteCart');
Route::post('/update-cart', 'Customer\CartController@updateCart');
// });

// Route::group(['prefix' => 'product'], function () {

Route::post('/product_by_price/{id}', 'Customer\ProductController@product_by_price');
Route::post('/product-details/{id}', 'Customer\ProductController@getProductDetails');
// Route::post('/category_filter', 'Customer\ProductController@category_filter');
Route::post('/category_filter/{id}', 'Customer\ProductController@category_filter');


Route::post('/filter', 'Customer\ProductController@filter');


// });


// Route::group(['prefix' => 'order'], function () {
Route::post('/customer/confirm-order', 'Customer\OrderController@pay');
Route::post('/customer/shipping-info',  'Customer\ProductController@shippinginfo');
// });

// Route::group(['prefix' => 'customer'], function () {
Route::post('/customer-login', 'CustomerController@login');
Route::post('/customer-register', 'CustomerController@register');
Route::post('/customer/customer-logout', 'CustomerController@logout');
Route::post('/customer-session', 'CustomerController@sessionData');;
// });
