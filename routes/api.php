<?php

use App\Http\Controllers\Customer\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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


Route::get('/login', function () {

    return view('api.master');
});

Route::get('/register', function () {

    return view('api.master');
});


Route::post('/login', 'API\AuthController@signin');
Route::post('/register', 'API\AuthController@signup');


Route::post('/logout', 'API\AuthController@logout')->middleware('auth:sanctum');
Route::middleware('auth:sanctum')->get('/blogs', 'API\BlogController@index');

Route::group(['prefix' => 'paypal'], function () {

    Route::post('process-transaction', [OrderController::class, 'pay'])->name('processTransaction');
    Route::get('success-transaction', [OrderController::class, 'success'])->name('successTransaction');
    Route::get('cancel-transaction', [OrderController::class, 'cancel'])->name('cancelTransaction');
});
