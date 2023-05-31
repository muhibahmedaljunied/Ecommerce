<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaypalPaymentController;




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

    
Auth::routes();

// Route::post('paypal/order/create',[PaypalPaymentController::class,'create'])->name('create');
// Route::get('create-transaction', [OrderController::class, 'createTransaction'])->name('createTransaction');
// Route::get('process-transaction', [OrderController::class, 'processTransaction'])->name('processTransaction');
// Route::get('success-transaction', [OrderController::class, 'successTransaction'])->name('successTransaction');
// Route::get('cancel-transaction', [OrderController::class, 'cancelTransaction'])->name('cancelTransaction');

// -----------------stripe-------------------

Route::get('create-transaction', [PaypalPaymentController::class, 'createTransaction'])->name('createTransaction');
Route::get('process-transaction', [PaypalPaymentController::class, 'processTransaction'])->name('processTransaction');
Route::get('success-transaction', [PaypalPaymentController::class, 'successTransaction'])->name('successTransaction');
Route::get('cancel-transaction', [PaypalPaymentController::class, 'cancelTransaction'])->name('cancelTransaction');





