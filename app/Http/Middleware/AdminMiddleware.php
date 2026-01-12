<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if user is logged in via 'web' guard
        if (Auth::guard('web')->check()) {
            // Assuming role 1 is Admin/Staff.
            // If strictly Admin is 1, use == 1.
            // If 3 is Customer (default), preventing 3 is safer for legacy data.
            if (Auth::guard('web')->user()->role != 3) {
                return $next($request);
            }
        }

        return redirect('/')->with('error', 'You do not have administrative access.');
    }
}
