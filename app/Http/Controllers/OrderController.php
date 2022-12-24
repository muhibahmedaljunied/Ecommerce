<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderDetail;
use Illuminate\Http\Request;
use App\User;
use DB;
use App\ShippingAddress;
use App\Payment;
use App\Temporale;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        // $this->middleware('Admin');


    }
    public function index()
    {

        $order = DB::table('orders')
            ->join('users', 'orders.customer_id', '=', 'users.id')
            ->select('orders.*', 'users.name as customer_name')
            ->get();
        return response()->json($order);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    public function shippingInfo(Request $request)
    {

        $shippingInfo = new ShippingAddress();
        $shippingInfo->customer_id = $request->id;
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->post('type') == 'cash') {

            $cart1 =Temporale::all(); 
            $cart = Temporale::select('sum(total) as total')
                ->select(DB::Raw('sum(total) as total'))
                ->get();
      
            // return response()->json($cart);
            // =====================================
            if (session()->get('person') == 0) {

                $customer = User::find(session()->get('customerId'))->id;
            } else {
                $id = Auth::user()->id;
                $customer = User::find($id);
            }
            // =====================================
            

            $order = new Order();
            $order->customer_id = $customer;
            $order->shipping_id = Session::get('shippingId');
            $order->order_total = $cart[0]->total;
            $order->save();

            $payment = new Payment();
            $payment->order_id = $order->id;
            $payment->payment_info = $request->type;
            $payment->save();


            foreach ($cart1 as $cartProduct) {
                // return response()->json($cartProduct->id);
                $orderDetails = new OrderDetail();
                $orderDetails->order_id = $order->id;
                $orderDetails->product_id = $cartProduct->id;
                // $orderDetails->product_name = $cartProduct['name'];
                // $orderDetails->price = $cartProduct->price;
                $orderDetails->quantity = $cartProduct->qty;
                $orderDetails->total = $cartProduct->price * $cartProduct->qty;
                $orderDetails->save();
            }
            // Cart::destroy();
            $product = Temporale::truncate();
            // session()->forget('cart');

            return response()->json($orderDetails);
        }
        // if ($request->type == 'stripe') {

        //     Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        //     Stripe\Charge::create ([
        //             "amount" => 100 * 100,
        //             "currency" => "usd",
        //             "source" => $request->stripeToken,
        //             "description" => "Test payment from itsolutionstuff.com." 
        //     ]);

        //     $order = new Order();
        //     $order->customer_id = Session::get('customerId');
        //     $order->shipping_id = Session::get('shippingId');
        //     $order->order_total = Cart::subtotal();
        //     $order->save();

        //     $payment = new Payment();
        //     $payment->order_id = $order->id;
        //     $payment->payment_info = $request->type;
        //     $payment->save();

        //     $cartProducts = Cart::content();
        //     foreach($cartProducts as $cartProduct){
        //         $orderDetails = new OrderDetail();
        //         $orderDetails->order_id = $order->id;
        //         $orderDetails->product_id = $cartProduct->id;
        //         $orderDetails->product_name = $cartProduct->name;
        //         $orderDetails->product_price = $cartProduct->price;
        //         $orderDetails->product_quantity = $cartProduct->qty;
        //         $orderDetails->save();
        //     }
        //     Cart::destroy();

        //     return response()->json('Order Confirmed');
        // }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
