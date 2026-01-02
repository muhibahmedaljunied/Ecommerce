<?php

namespace App\Services\Payment\PaymentMethods;

use App\Repository\PaymentRepositoryInterface;
use App\Models\ShippingAddress;
use App\Services\Payment\Traits\Store;
use App\Models\Temporale;
use Illuminate\Support\Facades\DB;

class CashPayment implements PaymentRepositoryInterface
{
    use Store;
    public function payment($request)
    {


        // dd($request->all());
        $this->request = $request->all();


            DB::beginTransaction(); // Tell Laravel all the code beneath this is a transaction



            $this->cart1 = Temporale::select('product_family_attribute_id', 'price', 'qty', 'total')->get();
            $this->cart = Temporale::select('sum(total) as total')
                ->select(DB::Raw('sum(total) as total'))
                ->get();

                // dd($this->cart);
            $this->shipping();

            $this->order_table();
            // dd(1);
            $this->payment_table();

            $this->orderDetails_table();
            Temporale::truncate();





        return $this->orderDetails;
    }

    public function shipping()
    {



        $shipping = new ShippingAddress();
        $shipping->full_name = $this->request['full_name'];
        $shipping->email_address = $this->request['email'];
        $shipping->phone_no = $this->request['number'];
        $shipping->address = $this->request['address'];
        $shipping->save();
        $this->shipping_id = $shipping->id;
    }
}
