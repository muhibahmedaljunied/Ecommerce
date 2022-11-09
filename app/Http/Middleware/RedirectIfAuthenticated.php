<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        
        // dd(Auth::user()->role);
     if (Auth::guard($guard)->check()) {
         
        if (Auth::user()->role == '3') {

            return redirect('customer/home');
        }
        if (Auth::user()->role == '1') {

            return redirect('category');
        }
     }     
        return $next($request);
    }
}
