<?php

namespace App\Services\Payment\PaymentMethods;
use App\Repository\PaymentRepositoryInterface;
use App\Models\ShippingAddress;
use App\Services\Payment\Traits\Store;
use App\Models\Temporale;
use Illuminate\Support\Facades\DB;
class CashPayment implements PaymentRepositoryInterface {
    use Store;
  public function payment($request)
    {
    

        $cart1 = Temporale::all();
        $cart = Temporale::select('sum(total) as total')
            ->select(DB::Raw('sum(total) as total'))
            ->get();

        $shipping_id = $this->shipping($request);
        $id = $this->order_table($cart,$shipping_id );
    
        $this->payment_table($id,$request);

        $orderDetails = $this->orderDetails_table($id,$cart1);
   
        Temporale::truncate();

        return $orderDetails;
       
    }

    public function shipping($request)
    {



        $shipping = new ShippingAddress();
        // $order->customer_id = $customer;
        $shipping->full_name = $request->post('full_name');
        $shipping->email_address = $request->post('email');
        $shipping->phone_no = $request->post('number');
        $shipping->address = $request->post('address');


        $shipping->save();

        return $shipping->id;

    }



}









 
