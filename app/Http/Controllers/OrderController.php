<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Payment\Pay;
// use App\Services\Payment\Traits\Payment;
use App\Services\Payment\Traits\Store;

use Illuminate\Support\Facades\Session;
use App\ShippingAddress;
use App\Order;
use DB;

class OrderController extends Controller
{

    use Store;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $gateway;

    public function __construct()
    {
        // $this->middleware('Admin');



    }
    public function index()
    {
        $order = DB::table('orders')
            ->join('shipping_addresses', 'orders.shipping_id', '=', 'shipping_addresses.id')
            ->select('orders.*', 'shipping_addresses.full_name as customer_name')
            ->get();
        return response()->json($order);
    }

    
    public function create()
    {
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

    public function pay(Request $request, Pay $pay)
    {
        // dd($request->all());

        $link = $pay->processTransaction($request);
        return response()->json($link);

       
    }


   


    public function show(Request $request)
    {
    }


    public function edit(Order $order)
    {
        //
    }


    public function update(Request $request, Order $order)
    {
        //
    }


    public function destroy(Order $order)
    {
        //
    }
}
