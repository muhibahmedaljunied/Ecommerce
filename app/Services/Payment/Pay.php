<?php

namespace App\Services\Payment;
use App\Services\Payment\Traits\Payment;
class Pay
{
    use Payment;
    public function processTransaction($request)
    {

        if ($request->post('type_pay') == 'cash')   {return $this->cash($request);}    
        if ($request->post('type_pay') == 'paypal') {return $this->paypal($request);} 
        if ($request->post('type_pay') == 'stripe') {return $this->stripe($request);}     
    

    }
}









 // $provider = new PayPalClient;
        // $provider->setApiCredentials(config('paypal'));
        // $paypalToken = $provider->getAccessToken();

        // $response = $provider->createOrder([
        //     "intent" => "CAPTURE",
        //     "application_context" => [
        //         "return_url" => route('successTransaction'),
        //         "cancel_url" => route('cancelTransaction')

        //     ],
        //     "purchase_units" => [
        //         0 => [
        //             "amount" => [
        //                 "currency_code" => "USD",
        //                 "value" => "1000.00"
        //             ]
        //         ]
        //     ]
        // ]);

        // if (isset($response['id']) && $response['id'] != null) {
        //     // redirect to approve href
        //     foreach ($response['links'] as $links) {



        //         if ($links['rel'] == 'approve') {

        //             return $links['href'];
        //         }
        //     }


        //     return redirect()
        //         ->route('customer', ['page' => 'payment', 'status' => 'error', 'message' => 'Something went wrong.']);
        //     // ->with('error', 'Something went wrong.');
        // } else {


        //     return redirect()
        //         ->route('customer', ['page' => 'payment', 'status' => 'canceld', 'message' => $response['message'] ?? 'Something went wrong.']);
        //     // ->with('error', $response['message'] ?? 'Something went wrong.');
        // }
