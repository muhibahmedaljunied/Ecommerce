<?php

namespace App\Services\Payment\PaymentMethods;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\Repository\PaymentRepositoryInterface;
use App\Services\Payment\Traits\Store;
use Illuminate\Http\Request;

class PaypalPayment implements PaymentRepositoryInterface {
    
    use Store;
    public function payment($request)
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

        dd($response);
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

    public function success(Request $request)
    {

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {

     
            $this->store($request);

            return redirect()
                ->route('customer', ['page' => 'payment', 'status' => 'success', 'message' => 'Transaction complete.']);
        } else {

            return redirect()
                ->route('customer', ['page' => 'payment', 'status' => 'error', 'message' => $response['message'] ?? 'Something went wrong.']);
        }
    }

    public function cancel(Request $request)
    {

        return redirect()
            ->route('customer', ['page' => 'payment', 'status' => 'canceld', 'message' => $response['message'] ?? 'You have canceled the transaction.']);
    }

}









 
