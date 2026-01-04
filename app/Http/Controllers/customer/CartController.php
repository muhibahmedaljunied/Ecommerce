<?php

namespace App\Http\Controllers\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Temporale;

class CartController extends Controller
{


    // -----------------------------
    /**
     * Add a product to the cart.
     *
     * @param  int  $id
     * @param  int  $cartQty
     * @return \Illuminate\Http\JsonResponse
     */
    public function addToCart($id, $cartQty)
    {

        // dd($id);
        $product = DB::table('product_family_attributes')
        ->where('product_family_attributes.id', $id)
        ->select('product_family_attributes.price')->get()->toArray();
        $temporale = Temporale::where('product_family_attribute_id', $id)->get();

        if (count($temporale) == 0) {

            $temporales = new Temporale();
            $temporales->product_family_attribute_id =  $id;
            $temporales->qty = $cartQty;
            $temporales->total =  $product[0]->price * $cartQty;
            $temporales->save();
        } else {
            $temporale = DB::table('temporales')->where('product_family_attribute_id', $id);
            $temporale->increment('qty', $cartQty);
            $temporale->increment('total', $product[0]->price * $cartQty);
        }


        return response()->json(['result' => $temporale]);
    }



    /**
     * Get all items in the cart.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function allCart()
    {

        $cart = Temporale::select('temporales.*', 'temporales.qty as qty_cart', 'products.*')
            ->join('product_family_attributes', 'product_family_attributes.id', '=', 'temporales.product_family_attribute_id')
            ->join('products', 'product_family_attributes.product_id', '=', 'products.id')
            ->select(
                'products.*',
                'product_family_attributes.*',
                'temporales.*',
                'temporales.qty as qty_cart'
            )
            ->get();





        if (isset($cart)) {
            $total = 0;
            $cart = $cart;
            foreach ($cart as $key => $value) {
                $total = $total + $value->total;
            }
        } else {

            $cart = 0;
        }

        return response()->json([
            'cart' => $cart,
            'session' => $cart,
            'count_cart' => count($cart),
            'subtotal' => $total
        ]);


        // return response()->json([
        // 'cart' => $cart,
        // 'session' => session()->get('cart'),
        // 'count_cart'=>$cart->totalQty,
        // 'subtotal' => $cart->totalPrice
        // ]);
    }

    /**
     * Remove an item from the cart.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteCart(Request $request)
    {

        $category = Temporale::find($request->id);
        $category->delete($request->post());

        return response()->json(['success' => 'product deleted from cart']);
    }

    /**
     * Update an item in the cart.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateCart(Request $request)
    {

        $total = Temporale::where('temporales.id', $request->id)
            ->join('products', 'products.id', 'temporales.product_id')
            ->get();
        // return response()->json($total);
        if ($total[0]->total != 0) {
            $cart = Temporale::where('id', $request->id)
                ->update([
                    'qty' => $request->post('qty'),
                    'total' => $request->post('qty') * $total[0]->price
                ]);
        } else {
            $cart = Temporale::where('id', $request->id)
                ->update([
                    'qty' => $request->post('qty'),
                    'total' => $request->post('qty') * $total[0]->price
                ]);
        }

        return response()->json($request);
    }
}
