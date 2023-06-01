<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::group(['prefix'=>'paypal'], function(){
    
Route::post('process-transaction', [OrderController::class, 'pay'])->name('processTransaction');
Route::get('success-transaction', [OrderController::class, 'success'])->name('successTransaction');
Route::get('cancel-transaction', [OrderController::class, 'cancel'])->name('cancelTransaction');
});







