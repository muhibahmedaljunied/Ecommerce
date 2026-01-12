<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

Route::post('/dashboard', 'HomeController@show')->name('dashboard');

// Route::group(['prefix' => 'category'], function () {
Route::post('/tree_product/{id}', [ProductController::class, 'tree_product']);
Route::post('/tree_product', [ProductController::class, 'tree_product_admin']);

Route::post('/category', [CategoryController::class, 'index']);
Route::get('/create_category', [ProductController::class, 'create']);
Route::post('/store_category', [ProductController::class, 'store_category']);
Route::post('/edit_category/{id}', [CategoryController::class, 'edit']);
Route::post('/update_category/{id}', [ProductController::class, 'update']);
Route::post('/delete_category/{id}', [ProductController::class, 'destroy']);
Route::post('/admin_category_filter/{id}', [CategoryController::class, 'category_filter']);


// });

// Route::group(['prefix' => 'user'], function () {

Route::post('/user', [UserController::class, 'index']);
Route::get('/create_user', [UserController::class, 'create']);
Route::post('/store_user', [UserController::class, 'store']);
Route::post('/update_user/{id}', [UserController::class, 'update']);
Route::get('/edit_user/{id}', [UserController::class, 'edit']);
Route::post('/delete_user/{id}', [UserController::class, 'destroy']);
// });

// Route::group(['prefix' => 'product'], function () {

Route::post('/product', 'ProductController@index')->name('product');
Route::post('/get_product_status/{id}', 'ProductController@get_product_status');

Route::post('/get_attribute', 'ProductController@get_attribute');


Route::post('/create_product', 'ProductController@create');
Route::post('/store_product', 'ProductController@store');
Route::post('/store_product_as_category', 'ProductController@store_as_category');

Route::post('/edit_product/{id}', 'ProductController@edit');
Route::post('/update_product/{id}', 'ProductController@update');
Route::post('/delete_product/{id}', 'ProductController@destroy');
// });


// Route::group(['prefix' => 'attribute'], function () {

Route::post('/attribute', 'AttributeController@index');
Route::post('/attribute_family/get_attributes', 'AttributeFamilyController@get_attribute');
Route::post('/product/get_attributes', 'AttributeController@get_attribute');
Route::get('/create_attribute', 'AttributeController@create');
// Route::get('/update_attribute', 'AttributeController@update');

Route::post('/store_attribute', 'AttributeController@store');
// Route::post('/edit_attribute/{id}', 'AttributeController@edit');
Route::post('/update_attribute/{id}', 'AttributeController@update');
Route::post('/delete_attribute/{id}', 'AttributeController@destroy');
// });




// Route::group(['prefix' => 'attribute_family'], function () {

Route::post('/attribute_family_mapping', 'AttributeFamilyMappingController@index');
Route::get('/create_attribute_family_mapping', 'AttributeFamilyMappingController@create');
Route::post('/edit_attribute_family_mapping/{id}', 'AttributeFamilyMappingController@edit');
Route::post('/store_attribute_family_mapping', 'AttributeFamilyMappingController@store');
Route::post('/update_attribute_family_mapping/{id}', 'AttributeFamilyMappingController@update');

Route::post('/delete_attribute_family_mapping/{id}', 'AttributeFamilyMappingController@destroy');

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

// Stock management endpoints
use App\Http\Controllers\StockController;
Route::post('/stock/adjust', [StockController::class, 'adjust']);
Route::get('/stock/transactions', [StockController::class, 'transactions']);
Route::get('/stock/transactions/latest', [StockController::class, 'lastTransaction']);
Route::get('/stock/low', [StockController::class, 'lowStockView']);
