<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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


// -----------------------------------------------------------------------customer----------------------------------
// Route::group(['prefix'=>['customer']],function(){
    Route::get('customer/{page}', function () {return view('customer/layouts/master');
    });
    
    Route::post('/customer-login', 'CustomerController@login');
    Route::post('/customer-register', 'CustomerController@register');
    Route::post('/customer/customer-logout', 'CustomerController@logout');
    Route::post('/customer-session', 'CustomerController@sessionData');
    Route::post('/home', 'CategoryController@index');
    Route::post('/category_c/{id}', 'ProductController@index');
    Route::post('/product_by_price/{id}', 'ProductController@product_by_price');
    Route::post('/product-details/{id}', 'ProductController@getProductDetails');
    Route::post('/featured-product','customer\CartController@getFeaturedProducts');
    Route::post('/new-product','customer\CartController@getNewProducts');

    Route::get('/add-cart/{id}/{cartQty}', 'customer\CartController@addToCart');
    Route::post('/customer/shipping-info', 'OrderController@shippinginfo');
    Route::post('/all-cart', 'customer\CartController@allCart');
    Route::post('/delete-cart', 'customer\CartController@deleteCart');
    Route::post('/update-cart', 'customer\CartController@updateCart');
    Route::post('/customer/confirm-order', 'OrderController@store');

// });    


// ---------------------------

Route::group(['middleware'=>['guest']],function(){
    // dd('sad');

    Route::get('/login', function () {return view('auth/login');
    });
    
});

Auth::routes();

Route::get('/logout', 'HomeController@logout');

Route::group(['middleware'=>['auth']],function(){

  
    Route::group(['middleware'=>['Customer']],function(){

        Route::get('/{page}', function () {return view('admin/layouts/master');
        });
        Route::get('/', function () {return view('admin/layouts/master');
        });
       
    });
    Route::post('/dashboard', 'HomeController@show');
    #######################Category##############################
    Route::post('/category', 'CategoryController@index');
    Route::get('/create_category', 'CategoryController@create');
    Route::post('/store_category', 'CategoryController@store');
    Route::post('/update_category/{id}', 'CategoryController@update');
    Route::post('/category/{id}', 'CategoryController@edit');
    Route::post('/delete_category/{id}', 'CategoryController@destroy');
    #######################User##############################
    Route::post('/user', 'UserController@index');
    Route::get('/create_user', 'UserController@create');
    Route::post('/store_user', 'UserController@store');
    Route::post('/update_user/{id}', 'UserController@update');
    Route::get('/user/{id}', 'UserController@edit');
    Route::post('/delete_user/{id}', 'UserController@destroy');
    ########################Product#############################
    Route::post('/product', 'ProductController@index');
    Route::post('/create_product', 'ProductController@create');
    Route::post('/store_product', 'ProductController@store');
    Route::post('/update_product/{id}', 'ProductController@update');
    Route::get('/product/{id}', 'ProductController@edit');
    Route::post('/delete_product/{id}', 'ProductController@destroy');
    #########################Country############################
    Route::post('/country', 'CountryController@index');
    Route::get('/create_country', 'CountryController@create');
    Route::post('/store_country', 'CountryController@store');
    Route::post('/update_country/{id}', 'CountryController@update');
    Route::post('/country/{id}', 'CountryController@edit');
    Route::post('/delete_country/{id}', 'CountryController@destroy');
    ##########################Size###########################
    Route::post('/size', 'SizeController@index');
    Route::get('/create_size', 'SizeController@create');
    Route::post('/store_size', 'SizeController@store');
    Route::post('/update_size/{id}', 'SizeController@update');
    Route::post('/size/{id}', 'SizeController@edit');
    Route::post('/delete_size/{id}', 'SizeController@destroy');
    ##########################Order#################################
    Route::post('/order', 'OrderController@index');
    Route::post('/order-details/{id}', 'OrderDetailController@index');
    Route::post('/order-invoice/{id}', 'OrderDetailController@orderinvoice');
    Route::post('/product-order/{id}', 'OrderDetailController@orderproduct');
    Route::post('/customer-order/{id}', 'OrderDetailController@ordercustomer');
    Route::post('/user_name','HomeController@show');

    // Route::get('/{page}', function () {return view('admin/layouts/master');
    // });
   
});














