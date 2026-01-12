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

            // Detect if the payment implementation already processed the cart (e.g. Store::store clears temporales)
            $cartProcessedByPayment = \App\Models\Temporale::count() === 0;

            // The payment service may return an Order or an OrderDetail or other structure.
            // Try to resolve to an Order if possible; otherwise we'll fallback to building one from temporales
            $order = null;
            if ($link instanceof \App\Models\Order) {
                $order = $link;
            } elseif (is_array($link) && isset($link['order'])) {
                $order = $link['order'];
            } elseif (is_object($link) && isset($link->order)) {
                $order = $link->order;
            } elseif ($link instanceof \App\Models\OrderDetail) {
                $order = \App\Models\Order::find($link->order_id);
            } elseif ($link instanceof \Illuminate\Support\Collection && $link->first() instanceof \App\Models\OrderDetail) {
                $order = \App\Models\Order::find($link->first()->order_id);
            } elseif (is_array($link) && isset($link['order_id'])) {
                $order = \App\Models\Order::find($link['order_id']);
            } elseif (is_object($link) && isset($link->order_id)) {
                $order = \App\Models\Order::find($link->order_id);
            }

            if (!$order) {
                // Only build an order from temporales if there are cart items remaining.
                $temporales = \App\Models\Temporale::all();
                if ($temporales->count() > 0) {
                    $order = new \App\Models\Order();
                    $order->order_total = $temporales->sum('total') ?? 0;
                    $order->save();

                    foreach ($temporales as $detail) {
                        $variant = \App\Models\ProductFamilyAttribute::find($detail->product_family_attribute_id);
                        if ($variant) {
                            if ($variant->qty < $detail->qty) {
                                throw new \Exception('Insufficient stock to complete checkout');
                            }

                            // decrement variant qty
                            $variant->decrement('qty', $detail->qty);

                            // log transaction
                            \App\Models\StockTransaction::create([
                                'product_family_attribute_id' => $variant->id,
                                'change' => -$detail->qty,
                                'type' => 'sale'
                            ]);

                        }
                    }

                    // Remove temporales entries after successful processing
                    \App\Models\Temporale::truncate();
                } elseif ($cartProcessedByPayment) {
                    // Payment implementation processed the cart already (e.g. Cash on Delivery flow).
                    // Try to locate the created order (best effort: recent order within last 5 minutes)
                    $order = \App\Models\Order::where('created_at', '>=', now()->subMinutes(5))->latest()->first();
                    // If we still don't have an order, that's OK — nothing else to do here since payment handled stock and details.
                }
            }

            // If an order exists but was NOT already processed by the payment implementation, decrement stock now.
            if ($order && !$cartProcessedByPayment) {
                foreach ($order->orderDetails as $detail) {
                    $product = Product::find($detail->product_id);
                    if ($product) {
                        if ($product->stock < $detail->quantity) {
                            throw new \Exception("Out of stock");
                        }
                        $product->stock -= $detail->quantity;
                        $product->save();
                    }
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

            \Illuminate\Support\Facades\Log::error('OrderController@pay error: ' . $exp->getMessage());

            return response([
                'message' => $exp->getMessage(),
                'data'=>'',
                'status' => 'failed'
            ], 400);
        }
    }


}
