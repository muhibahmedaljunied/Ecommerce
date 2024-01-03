<?php

namespace App\Http\Controllers\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Temporale;

class CartController extends Controller
{


    // -----------------------------
    public function addToCart($id, $cartQty)
    {

        // $product = ProductAttribute::find($id);

    
        
        $product = DB::table('product_attributes')
        ->where('product_attributes.product_id', $id)
        ->select('product_attributes.price')->get()->toArray();

        // dd($product[0]->price);
        // $temporale = Temporale::select('temporales.*')->where('temporales.product_id',$id)->get();
        $temporale = Temporale::where('product_id', $id)->get();
        // return response()->json(['result' => $temporale]);

        if (count($temporale) == 0) {

            $temporales = new Temporale();
            $temporales->product_id =  $id;
            $temporales->qty = $cartQty;
            $temporales->total =  $product[0]->price * $cartQty;
            $temporales->save();
        } else {
            $temporale = DB::table('temporales')->where('product_id', $id);
            $temporale->increment('qty', $cartQty);
            $temporale->increment('total', $product[0]->price * $cartQty);
        }


        return response()->json(['result' => $temporale]);
    }



    public function allCart()
    {



        // $cart = Temporale::select('temporales.*', 'temporales.qty as qty_cart', 'products.*')
        //     ->join('products', 'products.id', '=', 'temporales.product_id')
        //     ->get();

        $cart = Temporale::select('temporales.*', 'temporales.qty as qty_cart', 'products.*')
            ->join('products', 'products.id', '=', 'temporales.product_id')
            ->join('product_attributes', 'product_attributes.product_id', '=', 'products.id')
            ->select(
                'products.*',
                'product_attributes.*',
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

    public function deleteCart(Request $request)
    {

        $category = Temporale::find($request->id);
        $category->delete($request->post());

        return response()->json(['success' => 'product deleted from cart']);
    }

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
