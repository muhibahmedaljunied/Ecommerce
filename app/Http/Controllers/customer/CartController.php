<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Product;
use App\Temporale;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{

    public function index()
    {
    }

    // -----------------------------
    public function addToCart($id, $cartQty)
    {

        $product = Product::find($id);
        // $temporale = Temporale::select('temporales.*')->where('temporales.product_id',$id)->get();
        $temporale = Temporale::where('product_id', $id)->get();
        // return response()->json(['result' => $temporale]);

        if (count($temporale) == 0) {

            $temporales = new Temporale();
            $temporales->product_id =  $id;
            $temporales->qty = $cartQty;
            $temporales->total =  $product->price * $cartQty;
            $temporales->save();
        } else {
            $temporale = DB::table('temporales')->where('product_id', $id);
            $temporale->increment('qty', $cartQty);
            $temporale->increment('total', $product->price * $cartQty);
        }


        return response()->json(['result' => $temporale]);
    }



    public function allCart()
    {



        $cart = Temporale::select('temporales.*', 'temporales.qty as qty_cart', 'products.*')
            ->join('products', 'products.id', '=', 'temporales.product_id')
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

        DB::table('temporales')->where('product_id', '=', $request->post('id'))->delete();

        return response()->json(['success' => 'product deleted from cart']);
    }

    public function updateCart(Request $request)
    {

        $total = Temporale::where('product_id', $request->post('id'))->join('products','products.id','temporales.product_id')->get();

        if($total[0]->total != 0){
            $cart = Temporale::where('product_id', $request->post('id'))->update(['qty' => $request->post('qty'),'total' => $request->post('qty')*$total[0]->price]);

        }else{
            $cart = Temporale::where('product_id', $request->post('id'))->update(['qty' => $request->post('qty'),'total' => $request->post('qty')*$total[0]->price]);

        }
        
        


        // $cart = new Cart(session()->get('cart'));
        // $cart->updateQty($request->post('id'), $request->post('qty'));
        return response()->json($request);
    }

    public function getFeaturedProducts()
    {
        $featuredProduct = Product::where('status', 1)
            ->limit(3)
            ->get();

        //return $featuredProduct;
        return response()->json($featuredProduct);
    }

    public function getNewProducts()
    {
        $newProduct = Product::where('status', 1)
            ->orderBy('id', 'desc')
            ->limit(8)
            ->get();
        //return $featuredProduct;
        return response()->json($newProduct);
    }
}
