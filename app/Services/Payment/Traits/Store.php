<?php

namespace App\Services\Payment\Traits;
use Illuminate\Support\Facades\Session;
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
   
}
