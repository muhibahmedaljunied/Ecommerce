<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller

{
    public function index(){
    	$user = User::all();
        return response()->json($user);  
    }

    public function create(Request $request){
    	$user = new User();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->address = $request->address;
        $user->role = $request->role;
        $user->status = $request->status;
        $user->save();

        return back();
    }
}
