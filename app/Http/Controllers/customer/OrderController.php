<?php

namespace App\Http\Controllers\Customer;
use App\Repository\PaymentRepositoryInterface;
use Illuminate\Http\Request;
use App\Services\Payment\Traits\Store;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Models\ShippingAddress;
use DB;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    use Store;

    public $payment;

    /**
     * Create a new controller instance.
     *
     * @param  \App\Repository\PaymentRepositoryInterface  $payment
     * @return void
     */
    public function __construct(PaymentRepositoryInterface $payment)
    {
        $this->payment = $payment;


    }


    /**
     * Store shipping information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
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

    /**
     * Process the payment and handle order completion.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function pay(Request $request)
    {
        try {
            DB::beginTransaction();

            $link = $this->payment->payment($request);

            // Assume $order is the newly created order from your payment repo
            // Loop through order details and decrement stock
            foreach ($order->orderDetails as $detail) {
                $product = Product::find($detail->product_id);
                if ($product) {
                    if ($product->stock < $detail->quantity) {
                        throw new \Exception("Out of stock");
                    }
                    $product->stock -= $detail->quantity;
                    $product->save();
                    // Optional: If stock <= 0, mark as out of stock or notify admin
                }
            }

            DB::commit(); // Tell Laravel this transacion's all good and it can persist to DB
            return response([
                'message' => "purchase created successfully",
                'data'=>$link,
                'status' => "success"
            ], 200);
        } catch (\Exception $exp) {
            DB::rollBack(); // Tell Laravel, "It's not you, it's me. Please don't persist to DB"

            return response([
                'message' => $exp->getMessage(),
                'data'=>'',
                'status' => 'failed'
            ], 400);
        }
    }


}
