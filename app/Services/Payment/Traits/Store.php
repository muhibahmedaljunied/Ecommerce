<?php

namespace App\Services\Payment\Traits;
use Illuminate\Support\Facades\Session;
use App\Models\Temporale;
use App\Models\Payment as Pay;
use App\Models\OrderDetail;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

trait Store
{
    public $shipping_id;
    public $request;
    public $order_id;
    public $cart;
    public $cart1;
    public $orderDetails;
  


    public function store()
    {
    
       
        $this->cart1 = Temporale::all();
        $this->cart = Temporale::select('sum(total) as total')
            ->select(DB::Raw('sum(total) as total'))
            ->get();

        $this->order_table();
    
        $this->payment_table();

        $this->orderDetails_table();
   
        Temporale::truncate();

        return $this->orderDetails;
       
    }



    public function order_table()
    {



        $order = new Order();
        $order->shipping_id = $this->shipping_id;
        $order->order_total = $this->cart[0]->total;
        $order->save();

        $this->order_id = $order->id;
        // return $order->id;

    }


    public function orderDetails_table()
    {

        // dd($this->cart1);
        foreach ($this->cart1 as $cartProduct) {
            $orderDetails = new OrderDetail();
            $orderDetails->order_id = $this->order_id;
            $orderDetails->product_family_attribute_id = $cartProduct->product_family_attribute_id;
            $orderDetails->price = $cartProduct->price;
            $orderDetails->quantity = $cartProduct->qty;
            $orderDetails->total = $cartProduct->total;
            $orderDetails->save();
        }

        $this->orderDetails = $orderDetails;

    }


    public function payment_table()
    {


        $payment = new Pay();
        $payment->order_id = $this->order_id;
        $payment->payment_info = $this->request['type'];
        $payment->save();

    }



   
}
