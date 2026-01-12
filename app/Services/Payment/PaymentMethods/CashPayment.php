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
        $this->request = $request->all();

        // Store shipping info first so Store::store() can use shipping_id
        $this->shipping();

        // Delegate processing to Store::store() which handles transactions and stock validation/decrement
        return $this->store();
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
