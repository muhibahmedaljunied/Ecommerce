<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;


class AuthController extends BaseController
{

    public function signin(Request $request)
    {

        $user = User::where('email',  $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => ['Username or password incorrect'],
            ]);
        }

        $user->tokens()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'User logged in successfully',
            'name' => $user->name,
            'token' => $user->createToken('auth_token')->plainTextToken,
        ]);
    }


    // public function signin(Request $request)
    // {



    //     if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 

    //         $authUser = Auth::user(); 

    //         // return $this->sendResponse($authUser, 'User signed in');

    //         $authUser = User::find($authUser['id']); 


    //         $success['token'] =  $authUser->createToken('MyAuthApp')->plainTextToken; 
    //         $success['name'] =  $authUser->name;



    //         return response()->json([
    //             'user' => $authUser,
    //             'authorization' => [
    //                 'token' =>  $success['token'],
    //                 'type' => 'bearer',
    //             ]
    //         ]);


    //         // return $this->sendResponse($success, 'User signed in');
    //     } 
    //     else{ 
    //         return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
    //     } 
    // }
    public function signup(Request $request)
    {


        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);
        return response()->json([
            'name' => $user->name,
            'email' => $user->email,
        ]);
    }


    // public function logout()
    // {
    //     Auth::user()->tokens()->delete();
    //     return response()->json([
    //         'message' => 'logout success'
    //     ]);
    // }


    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(
            [
                'status' => 'success',
                'message' => 'User logged out successfully'
            ]
        );
    }
}
