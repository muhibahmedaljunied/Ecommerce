<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Stripe;
use Session;
class PaymentsController extends Controller
{
    /**
     * payment view
     */
    public function handleGet()
    {
        return view('home');
    }
  
    /**
     * handling payment with POST
     */
    public function handlePost(Request $request)
    {

        // dd($request);
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" => 100 * 150,
                "currency" => "inr",
                "source" => $request->stripeToken,
                "description" => "Making test payment." 
        ]);
  
        Session::flash('success', 'Payment has been successfully processed.');
          
        return back();
    }
}