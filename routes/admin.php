<?php 
Route::post('/dashboard', 'HomeController@show')->name('dashboard');
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
Route::post('/product', 'ProductController@index')->name('product');
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
Route::post('/payment-details/{id}', 'OrderDetailController@orderpayment');

Route::post('/user_name', 'HomeController@show');

Route::get('/{page}', function () {
    return view('admin/layouts/master');
});
