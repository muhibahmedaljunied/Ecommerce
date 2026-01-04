<?php

namespace App\Http\Controllers;

use Hash;
use Mail;
use Session;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
	public function __construct()
    {
                // $this->middleware('Customer');


    }

    /**
     * Register a new customer.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request){

    	$this->validate($request,[
    		'first_name' => 'required|string',
    		'email_address' => 'required|unique:customers',
    		'password' => 'required|min:5'
    	]);

    	/*$validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
    		'email_address' => 'required|unique:customers',
    		'password' => 'required|min:5'
        ]);
        if ($validator->fails()) {
            return response()->json([
            	'errors'=>$validator->errors()
            ]);
        }*/

    	$customer = new Customer();

    	$customer->first_name = $request->first_name;
    	$customer->last_name = $request->last_name;
    	$customer->email_address = $request->email_address;
    	$customer->phone_no = $request->phone_no;
    	$customer->password = bcrypt($request->password);
    	$customer->address = $request->address;
    	$customer->save();
        session()->put('customerId',$customer->id);

    	// $data = $customer->toArray();
        // Mail::send('vendor.mail',$data,function ($message) use ($data){
        //     $message->to($data['email_address']);
        //     $message->subject('Welcome to Eiser Shop');
        // });

    	return response()->json('Done');
    }

    /**
     * Log in a customer.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request){



    	$customer = User::where('email',$request->email_address)->first();
		Auth::login($customer);
    	if ($customer) {
    		if (Hash::check($request->password, $customer->password)) {
				session()->put('person',0);
    			session()->put('customerId',$customer->id);
				session()->put('customerName',$customer->first_name.' '.$customer->last_name);
    			// Session::put('customerName',$customer->first_name.' '.$customer->last_name);

    			return response()->json($customer);
    		};
    	}

    	return response()->json("Error");

    	/*if (password_verify($request->password, $customer->password)) {
    		return response()->json($data);
    	}else{
    		return response()->json("Error");
    	}*/
    }

    /**
     * Log out a customer.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(){

		Auth::logout();
        session()->forget('customerId');



        return response()->json(session()->get('customerId'));
    }

    /**
     * Get the session data for the logged in customer.
     *
     * @return \Illuminate\Http\Response
     */
    public function sessionData(){

		if(session()->get('person') == 0){

			$customer = User::find(session()->get('customerId'));
		}else{
			$id = Auth::user()->id;
			$customer = User::find($id);
		}


        return response()->json([
            's_customer' => $customer
        ]);
    }
}
