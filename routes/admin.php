<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

Route::post('/dashboard', 'HomeController@show')->name('dashboard');

// Route::group(['prefix' => 'category'], function () {

Route::post('/category', [CategoryController::class, 'index']);
Route::get('/create_category', [CategoryController::class, 'create']);
Route::post('/store_category', [CategoryController::class, 'store']);
Route::post('/update_category/{id}', [CategoryController::class, 'update']);
Route::post('/category/{id}', [CategoryController::class, 'edit']);
Route::post('/delete_category/{id}', [CategoryController::class, 'destroy']);
// });

// Route::group(['prefix' => 'user'], function () {

Route::post('/user', [UserController::class, 'index']);
Route::get('/create_user', [UserController::class, 'create']);
Route::post('/store_user', [UserController::class, 'store']);
Route::post('/update_user/{id}', [UserController::class, 'update']);
Route::get('/user/{id}', [UserController::class, 'edit']);
Route::post('/delete_user/{id}', [UserController::class, 'destroy']);
// });

// Route::group(['prefix' => 'product'], function () {

Route::post('/product', 'ProductController@index')->name('product');
Route::post('/create_product', 'ProductController@create');
Route::post('/store_product', 'ProductController@store');
Route::post('/update_product/{id}', 'ProductController@update');
Route::get('/product/{id}', 'ProductController@edit');
Route::post('/delete_product/{id}', 'ProductController@destroy');
// });


// Route::group(['prefix' => 'country'], function () {

Route::post('/country', 'CountryController@index');
Route::get('/create_country', 'CountryController@create');
Route::post('/store_country', 'CountryController@store');
Route::post('/update_country/{id}', 'CountryController@update');
Route::post('/country/{id}', 'CountryController@edit');
Route::post('/delete_country/{id}', 'CountryController@destroy');
// });




// Route::group(['prefix' => 'size'], function () {

Route::post('/size', 'SizeController@index');
Route::get('/create_size', 'SizeController@create');
Route::post('/store_size', 'SizeController@store');
Route::post('/update_size/{id}', 'SizeController@update');
Route::post('/size/{id}', 'SizeController@edit');
Route::post('/delete_size/{id}', 'SizeController@destroy');
// });


// Route::group(['prefix' => 'order'], function () {

Route::post('/order', 'OrderController@index');
Route::post('/order-details/{id}', 'OrderDetailController@index');
Route::post('/order-invoice/{id}', 'OrderDetailController@orderinvoice');
Route::post('/product-order/{id}', 'OrderDetailController@orderproduct');
Route::post('/customer-order/{id}', 'OrderDetailController@ordercustomer');
Route::post('/payment-details/{id}', 'OrderDetailController@orderpayment');
// });


Route::post('/user_name', 'HomeController@show');
