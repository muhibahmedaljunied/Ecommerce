<?php

namespace App\Services\Payment\PaymentMethods;
use App\Services\Payment\Traits\Store;
class CashPayment{
    use Store;
    public function cash($request)
    {
        $this->store($request);
       
    }

}









 
