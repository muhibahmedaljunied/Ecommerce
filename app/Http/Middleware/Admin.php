<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // if (Auth::check()) {

        //     if (Auth::user()->role == '3' ) {
        //         return redirect('/customer/home');
        //     } 
        //     if (Auth::user()->role == '1' ) {
        //         return redirect('/dashboard');
        //     }       
        //  }
        

        return $next($request); 
       }
}
