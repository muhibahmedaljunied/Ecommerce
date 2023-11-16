<?php

namespace App\Services\Payment\PaymentMethods;
use App\Repository\PaymentRepositoryInterface;
use App\Services\Payment\Traits\Store;
class CashPayment implements PaymentRepositoryInterface {
    use Store;
    public function payment($request)
    {
        $this->store($request);
        
       
    }

}









 
