<?php

namespace App\Http\Controllers;
use App\Repository\PaymentRepositoryInterface;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Services\Payment\Traits\Store;
use Illuminate\Support\Facades\Session;
use App\Models\ShippingAddress;
use DB;
class OrderController extends Controller
{

    use Store;

    // public $payment;
    // public function __construct(PaymentRepositoryInterface $payment)
    // {
    //     $this->payment = $payment;
  

    // }
    public function index()
    {
        $country = Country::all();

        $order = DB::table('orders')
            ->join('shipping_addresses', 'orders.shipping_id', '=', 'shipping_addresses.id')
            ->select('orders.*', 'shipping_addresses.full_name as customer_name')
            ->get();
          
        return response()->json(['country' => $country,'order'=>$order]);
    }


 


}
