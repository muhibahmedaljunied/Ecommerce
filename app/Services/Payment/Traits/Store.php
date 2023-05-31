<?php

namespace App\Services\Payment\Traits;

use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Temporale;
use App\Payment as Pay;
use App\OrderDetail;
use App\Order;
use DB;

trait Store
{



    public function store($request)
    {


        $cart1 = Temporale::all();
        $cart = Temporale::select('sum(total) as total')
            ->select(DB::Raw('sum(total) as total'))
            ->get();

        $order = new Order();
        // $order->customer_id = $customer;
        $order->shipping_id = Session::get('shippingId');
        $order->order_total = $cart[0]->total;
        $order->save();

        $payment = new Pay();
        $payment->order_id = $order->id;
        $payment->payment_info = $request->type;
        $payment->save();


        foreach ($cart1 as $cartProduct) {
            // return response()->json($cartProduct->id);
            $orderDetails = new OrderDetail();
            $orderDetails->order_id = $order->id;
            $orderDetails->product_id = $cartProduct->product_id;
            $orderDetails->price = $cartProduct->price;
            $orderDetails->quantity = $cartProduct->qty;
            $orderDetails->total = $cartProduct->total;
            $orderDetails->save();
        }
        $product = Temporale::truncate();

        return $orderDetails;
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
