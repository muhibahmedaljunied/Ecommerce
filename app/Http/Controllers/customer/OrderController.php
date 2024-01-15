<?php

namespace App\Http\Controllers\Customer;
use App\Repository\PaymentRepositoryInterface;
use Illuminate\Http\Request;
use App\Services\Payment\Traits\Store;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Models\ShippingAddress;
use DB;
class OrderController extends Controller
{

    use Store;

    public $payment;
    public function __construct(PaymentRepositoryInterface $payment)
    {
        $this->payment = $payment;
  

    }
 

    public function shippingInfo(Request $request)
    {

        $shippingInfo = new ShippingAddress();
        // $shippingInfo->customer_id = $request->id;
        $shippingInfo->full_name = $request->full_name;
        $shippingInfo->email_address = $request->email;
        $shippingInfo->phone_no = $request->number;
        $shippingInfo->address = $request->address;
        $shippingInfo->save();

        Session::put('shippingId', $shippingInfo->id);

        // return response()->json(Session::get());
        return response()->json("Shipping Info Putting in session");
    }

    public function pay(Request $request)
    {
 
        

        
        // try {

        $link = $this->payment->payment($request);

           
        DB::commit(); // Tell Laravel this transacion's all good and it can persist to DB
        return response([
            'message' => "purchase created successfully",
            'data'=>$link,
            'status' => "success"
        ], 200);
    // } catch (\Exception $exp) {

    //     DB::rollBack(); // Tell Laravel, "It's not you, it's me. Please don't persist to DB"


    //     return response([
    //         'message' => $exp->getMessage(),
    //         'data'=>'',
    //         'status' => 'failed'
    //     ], 400);
    // }
        return response()->json($link);

    }


}
