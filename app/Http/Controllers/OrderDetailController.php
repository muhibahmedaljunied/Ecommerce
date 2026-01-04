<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use App\Models\Order;
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
        // Find the order by its ID.
        $order = Order::find($id);
        // Return the order as a JSON response.
        return response()->json($order);
    }

    public function orderproduct($id)
    {
        $product = OrderDetail::where('order_id', $id)
            ->join('product_family_attributes', 'product_family_attributes.id', '=', 'order_details.product_family_attribute_id')
            ->join('products', 'products.id', '=', 'product_family_attributes.product_id')

            ->select(
                'products.*',
                'product_family_attributes.*',
                'product_family_attributes.price as product_price',
                'order_details.*',

            )
            ->get();
        return response()->json($product);
    }

    public function ordercustomer($id)
    {

        $customers = Order::where('orders.id', $id)
            ->join('payments', 'orders.id', '=', 'payments.order_id')
            ->join('shipping_addresses', 'shipping_addresses.id', '=', 'orders.shipping_id')
            // ->join('users','users.id', '=', 'shipping_addresses.customer_id')
            ->select('orders.*', 'shipping_addresses.*', 'payments.*')
            ->get();
        return response()->json($customers);
    }






    public function orderInvoice($orderId)
    {
        // $order = Order::with('customer','payment','shipping')->find($orderId);
        $order = Order::with('payment', 'shipping')->find($orderId);

        $productDetails = OrderDetail::where('order_id', $order->id)->get();
        //return $order;
        return view('admin.order.order-invoice', [
            'orderDetails' => $order,
            'productDetails' => $productDetails
        ]);
    }
}
