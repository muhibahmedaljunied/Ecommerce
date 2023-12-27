<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\category;
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
            $product = count(Product::all());
            $category = count(Category::all());
            $order = count(Order::all());

            return response()->json(['product'=>$product,'category'=>$category,'order'=>$order,'user'=>Auth::user()]);

    }
    public function logout() {
       
        Auth::logout();
        // DB::table('temporales')->delete();
     
        return redirect('/login');
      }
}
