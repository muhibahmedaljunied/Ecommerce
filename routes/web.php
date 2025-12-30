<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\LanguageController;
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

Route::get('/language/{locale}', [LanguageController::class, 'setLanguage'])->name('language.switch');
Route::post('/api/language/set', [LanguageController::class, 'setLanguageApi'])->name('language.set.api');
Route::get('/api/language/current', [LanguageController::class, 'getCurrentLanguage'])->name('language.current.api');
Route::get('/api/language/available', [LanguageController::class, 'getAvailableLanguages'])->name('language.available.api');

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
