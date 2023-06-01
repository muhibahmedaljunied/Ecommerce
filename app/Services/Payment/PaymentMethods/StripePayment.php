<?php

namespace App\Services\Payment\PaymentMethods;
use Stripe;
use Illuminate\Http\Request;
use App\Services\Payment\Traits\Store;

class StripePayment{
    
    use Store;
    public function handlePost(Request $request)
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









 
