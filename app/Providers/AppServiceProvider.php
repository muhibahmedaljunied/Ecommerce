<?php

namespace App\Providers;
use App\Repository\PaymentRepositoryInterface;
use App\Services\Payment\PaymentMethods\CashPayment;
use App\Services\Payment\PaymentMethods\PaypalPayment;
use App\Services\Payment\PaymentMethods\StripePayment;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        

          
        $this->app->bind(PaymentRepositoryInterface::class, function () {

            $request = app(\Illuminate\Http\Request::class);

            if ($request->post('type_pay') == 'cash') {
          
                return new CashPayment();
            }
            if ($request->post('type_pay') == 'paypal') {
                
                return new PaypalPayment();
            }
            if ($request->post('type_pay') == 'stripe') {
    
                return new StripePayment();
          
            }


        });






    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
