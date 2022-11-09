<?php

namespace App\Http\Controllers;

use App\OrderDetail;
use App\Order;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
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
    public function index($id)
    {
        $order = Order::find($id);
        return response()->json($order);
    }

    public function orderproduct($id)
    {
        $product = OrderDetail::where('order_id', $id)
        ->join('products','products.id', '=', 'order_details.product_id')
        ->select('products.*','order_details.*')
        ->get();
        return response()->json($product);
    }

    public function ordercustomer($id)
    {
        $customers = Order::where('orders.id', $id)
        ->join('users','users.id', '=', 'orders.customer_id')
        ->select('orders.*','users.*')
        ->get();
        return response()->json($customers);
    }

    
    public function orderInvoice($orderId){
    	$order = Order::with('customer','payment','shipping')->find($orderId);
    	$productDetails = OrderDetail::where('order_id', $order->id)->get();
    	//return $order;
    	return view('admin.order.order-invoice',[
    		'orderDetails'=>$order,
    		'productDetails' => $productDetails
    	]);
    }
}
