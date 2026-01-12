<?php

namespace App\Services\Payment\Traits;
use Illuminate\Support\Facades\Session;
use App\Models\Temporale;
use App\Models\Payment as Pay;
use App\Models\OrderDetail;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

trait Store
{
    public $shipping_id;
    public $request;
    public $order_id;
    public $cart;
    public $cart1;
    public $orderDetails;
    public $lowStockAlerts = [];



    public function store()
    {
        DB::beginTransaction();
        try {
            // Only select the columns we need from the temporales table
            $columns = ['product_family_attribute_id', 'qty', 'total'];
            $this->cart1 = Temporale::select($columns)->get();
            $this->cart = Temporale::select(DB::raw('sum(total) as total'))->first();

            // Validate stock availability for every cart item
            foreach ($this->cart1 as $item) {
                $variant = \App\Models\ProductFamilyAttribute::find($item->product_family_attribute_id);

                if (!$variant) {
                    throw new \Exception("Product variant not found (id: {$item->product_family_attribute_id})");
                }
                if ($variant->qty < $item->qty) {
                    throw new \Exception("Insufficient stock for variant id {$variant->id}");
                }
            }

            $this->order_table();

            $this->payment_table();

            $this->orderDetails_table();

            Temporale::truncate();

            DB::commit();

            return $this->orderDetails;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }



    public function order_table()
    {



        $order = new Order();
        $order->shipping_id = $this->shipping_id;
        $order->order_total = $this->cart ? ($this->cart->total ?? 0) : 0;
        $order->save();

        $this->order_id = $order->id;
        // return $order->id;

    }


    public function orderDetails_table()
    {

        // dd($this->cart1);
        foreach ($this->cart1 as $cartProduct) {
            // Resolve variant first (use its canonical price)
            $variant = \App\Models\ProductFamilyAttribute::find($cartProduct->product_family_attribute_id);

            $orderDetails = new OrderDetail();
            $orderDetails->order_id = $this->order_id;
            $orderDetails->product_family_attribute_id = $cartProduct->product_family_attribute_id;
            $orderDetails->price = $variant ? ($variant->price ?? 0) : 0;
            $orderDetails->quantity = $cartProduct->qty;
            $orderDetails->total = $cartProduct->total;
            $orderDetails->save();

            // Decrement stock for the product variant and log transaction
            if ($variant) {
                $variant->decrement('qty', $cartProduct->qty);

                // Log stock transaction
                \App\Models\StockTransaction::create([
                    'product_family_attribute_id' => $variant->id,
                    'change' => -1 * (int)$cartProduct->qty,
                    'type' => 'sale',
                    'reference_id' => $this->order_id,
                    'reference_type' => 'order',
                    'user_id' => auth()->id() ?? null,
                    'note' => 'Stock decreased on order creation'
                ]);

                // Collect low stock alerts for later reporting (optional)
                if ($variant->alert_qty !== null && $variant->qty <= $variant->alert_qty) {
                    $this->lowStockAlerts[] = [
                        'variant_id' => $variant->id,
                        'remaining' => $variant->qty,
 'alert_qty' => $variant->alert_qty
                    ];
                }
            }
        }

        $this->orderDetails = $orderDetails;

    }


    public function payment_table()
    {


        $payment = new Pay();
        $payment->order_id = $this->order_id;
        $payment->payment_info = $this->request['type'];
        $payment->save();

    }




}
