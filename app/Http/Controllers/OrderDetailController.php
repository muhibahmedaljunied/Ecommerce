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
        ->join('sizes','sizes.id', '=', 'products.size_id')
        ->join('countries','countries.id', '=', 'products.country_id')
        ->join('categories','categories.id', '=', 'products.category_id')
        ->select('products.*','products.price as product_price','order_details.*','sizes.name as size','countries.name as country','categories.name as category')
        ->get();
        return response()->json($product);
    }

    public function ordercustomer($id)
    {
        // $customers = Order::where('orders.id', $id)
        // ->join('payments','orders.id', '=', 'payments.order_id')
        // ->join('shipping_addresses','shipping_addresses.id', '=', 'orders.shipping_id')
        // ->join('users','users.id', '=', 'shipping_addresses.customer_id')
        // ->select('orders.*','users.*','shipping_addresses.*','payments.*')
        // ->get();
        $customers = Order::where('orders.id', $id)
        ->join('payments','orders.id', '=', 'payments.order_id')
        ->join('shipping_addresses','shipping_addresses.id', '=', 'orders.shipping_id')
        // ->join('users','users.id', '=', 'shipping_addresses.customer_id')
        ->select('orders.*','shipping_addresses.*','payments.*')
        ->get();
        return response()->json($customers);
    }

 

   

    
    public function orderInvoice($orderId){
    	// $order = Order::with('customer','payment','shipping')->find($orderId);
        $order = Order::with('payment','shipping')->find($orderId);

    	$productDetails = OrderDetail::where('order_id', $order->id)->get();
    	//return $order;
    	return view('admin.order.order-invoice',[
    		'orderDetails'=>$order,
    		'productDetails' => $productDetails
    	]);
    }
}
