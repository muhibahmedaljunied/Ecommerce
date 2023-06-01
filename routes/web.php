<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentsController;

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

require __dir__.'/customer.php';


// ---------------------------

// Route::group(['middleware'=>['guest']],function(){
//     // dd('sad');

//     Route::get('/login', function () {return view('auth/login');
//     });

// });

Auth::routes();

require __dir__.'/admin.php';


// Route::get('/logout', 'HomeController@logout');

// // Route::group(['middleware'=>['auth']],function(){


// Route::group(['middleware' => ['Customer']], function () {

//     Route::get('/{page}', function () {
//         return view('admin/layouts/master');
//     });
//     Route::get('/', function () {
//         return view('admin/layouts/master');
//     });
// });

// });
// -------------------------stripe------------------------------------------------------
// Route::group(['prefix' => 'stripe'], function () {

//     Route::get('/stripe-payment', [PaymentsController::class, 'handleGet']);
//     Route::post('/stripe-payment', [PaymentsController::class, 'handlePost'])->name('stripe.payment');
// });


Route::group(['prefix' => 'stripe'], function () {

    // Route::get('/stripe-payment', [PaymentsController::class, 'handleGet']);
    // Route::post('/stripe-payment', [PaymentsController::class, 'handlePost'])->name('stripe.payment');

    Route::post('/stripe-payment', [OrderController::class, 'pay'])->name('stripe.payment');
});
