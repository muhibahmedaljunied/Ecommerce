<?php

namespace App\Services\Payment;

use App\Services\Payment\PaymentMethods\CashPayment;
use App\Services\Payment\PaymentMethods\StripePayment;
use App\Services\Payment\PaymentMethods\PaypalPayment;
class Pay
{
    public $cash;
    public $paypal;
    public $stripe;

    public function __construct(CashPayment $cash, StripePayment $stripe, PaypalPayment $paypal)
    {
        $this->paypal = $paypal;
        $this->cash = $cash;
        $this->stripe = $stripe;
    }

    public function processTransaction($request)
    {

        if ($request->post('type_pay') == 'cash') {
            return $this->cash->cash($request);
        }
        if ($request->post('type_pay') == 'paypal') {
            return $this->paypal->paypal($request);
        }
        if ($request->post('type_pay') == 'stripe') {

            return $this->stripe->handlePost($request);
      
        }
    }
}
