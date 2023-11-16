<?php

namespace App\Services\Payment\PaymentMethods;
use App\Repository\PaymentRepositoryInterface;
use App\Services\Payment\Traits\Store;
use Illuminate\Http\Request;
use Stripe;

class StripePayment implements PaymentRepositoryInterface{
    
    use Store;
    public function payment($request)
    {

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" => 100 * 150,
                "currency" => "inr",
                "source" => $request->stripeToken,
                "description" => "Making test payment." 
        ]);
        $this->store($request);

        return ['message'=>'Payment has been successfully processed.'];
     
    }

}









 
