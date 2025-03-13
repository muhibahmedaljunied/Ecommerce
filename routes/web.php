<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentsController;
use Illuminate\Http\Request;
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



require __dir__ . '/customer.php';


Auth::routes();

Route::middleware('auth')->group(function () {







    Route::group(['prefix' => 'stripe'], function () {

        Route::post('/stripe-payment', [OrderController::class, 'pay'])->name('stripe.payment');
        
    });



    Route::get('/{page}', function () {
        return view('admin/layouts/master');
    });
    Route::get('/{page}/{id}', function () {
        return view('admin/layouts/master');
    });
    Route::get('/', function () {
        // dd(12);

        return view('admin/layouts/master');
    });


    Route::get('/logout', 'HomeController@logout');
    Route::post('/logout', 'HomeController@logout')->name('logout');

   

    require __dir__ . '/admin.php';


});
