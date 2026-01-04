<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
// use App\Models\category;
use App\Models\order;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('Admin');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
            return view('admin.layouts.master');

    }
    public function show()
    {
            // Get the total number of products.
            $product = count(Product::get(['id']));
            // $category = count(Category::all());
            // Get the total number of orders.
            $order = count(Order::get(['id']));
            // Return the counts of products, orders, and the authenticated user as a JSON response.
            return response()->json(['product'=>$product,
            // 'category'=>$category,
            'order'=>$order,'user'=>Auth::user()]);

    }
    public function logout() {
        // Log the user out.
        Auth::logout();
        // DB::table('temporales')->delete();
        // Redirect the user to the login page.
        return redirect('/login');
      }
}
