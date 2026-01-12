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
        // Check variant exists and current available qty
        $variant = DB::table('product_family_attributes')
            ->where('id', $id)
            ->select('price', 'qty')
            ->first();

        if (!$variant) {
            return response()->json(['error' => 'Product variant not found'], 404);
        }

        $temporale = Temporale::where('product_family_attribute_id', $id)->first();

        $existingQty = $temporale ? $temporale->qty : 0;
        $newQty = $existingQty + (int)$cartQty;

        if ($newQty > $variant->qty) {
            return response()->json(['error' => 'Not enough stock available'], 400);
        }

        if (!$temporale) {
            $temporales = new Temporale();
            $temporales->product_family_attribute_id =  $id;
            $temporales->qty = $cartQty;
            $temporales->total =  $variant->price * $cartQty;
            $temporales->save();
            $result = $temporales;
        } else {
            $temporale->increment('qty', $cartQty);
            $temporale->increment('total', $variant->price * $cartQty);
            $result = $temporale->fresh();
        }

        return response()->json(['result' => $result]);
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
        $temporale = Temporale::find($request->id);
        if (!$temporale) {
            return response()->json(['error' => 'Cart item not found'], 404);
        }

        $variant = DB::table('product_family_attributes')
            ->where('id', $temporale->product_family_attribute_id)
            ->select('price', 'qty')
            ->first();

        if (!$variant) {
            return response()->json(['error' => 'Product variant not found'], 404);
        }

        $newQty = (int)$request->post('qty');
        if ($newQty > $variant->qty) {
            return response()->json(['error' => 'Not enough stock available'], 400);
        }

        $temporale->qty = $newQty;
        $temporale->total = $newQty * $variant->price;
        $temporale->save();

        return response()->json(['success' => true, 'item' => $temporale]);
    }
}
