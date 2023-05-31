<?php

namespace App\Services\Payment\Traits;

use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\Services\Payment\Traits\Store;

trait Payment
{
    use Store;

    public function paypal($request)
    {


        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('successTransaction'),
                "cancel_url" => route('cancelTransaction')

            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => "1000.00"
                    ]
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {
            // redirect to approve href
            foreach ($response['links'] as $links) {



                if ($links['rel'] == 'approve') {

                    return $links['href'];
                }
            }


            return redirect()
                ->route('customer', ['page' => 'payment', 'status' => 'error', 'message' => 'Something went wrong.']);
        } else {


            return redirect()
                ->route('customer', ['page' => 'payment', 'status' => 'canceld', 'message' => $response['message'] ?? 'Something went wrong.']);
        }
        
    }
    
    public function stripe($request)
    {

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('successTransaction'),
                "cancel_url" => route('cancelTransaction')

            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => "1000.00"
                    ]
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {
            // redirect to approve href
            foreach ($response['links'] as $links) {



                if ($links['rel'] == 'approve') {

                    return $links['href'];
                }
            }


            return redirect()
                ->route('customer', ['page' => 'payment', 'status' => 'error', 'message' => 'Something went wrong.']);
        } else {


            return redirect()
                ->route('customer', ['page' => 'payment', 'status' => 'canceld', 'message' => $response['message'] ?? 'Something went wrong.']);
        }
        
    }

    public function cash($request)
    {
        $this->store($request);
       
    }
}
