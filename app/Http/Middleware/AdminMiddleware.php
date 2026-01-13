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
        // Use the authenticated user and check is_admin flag
        $user = $request->user();

        // If there is no authenticated user, mark admin intent and redirect to the login page
        if (!$user) {
            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json(['message' => 'Unauthorized. Please log in.'], 401);
            }
            // set a session flag so /login (without query) can detect admin intent
            session()->put('login_intent', 'admin');
            return redirect('/login');
        }

        // Allow access if user is admin by flag, role, or explicit permission
        $isAdminFlag = false;
        if (method_exists($user, 'isAdmin')) {
            $isAdminFlag = (bool) $user->isAdmin();
        } else {
            $isAdminFlag = (property_exists($user, 'is_admin') && $user->is_admin) || (isset($user->is_admin) && $user->is_admin);
        }

        $hasAdminRole = method_exists($user, 'hasRole') && $user->hasRole('admin');
        $hasAccessPermission = method_exists($user, 'hasPermission') && $user->hasPermission('access-admin');

        if ($isAdminFlag || $hasAdminRole || $hasAccessPermission) {
            return $next($request);
        }

        if ($request->expectsJson() || $request->is('api/*')) {
            return response()->json(['message' => 'Forbidden. Admins only.'], 403);
        }

        // Redirect non-admin authenticated users to the customer area to avoid redirect loops
        return redirect('/customer/home')->with('error', 'You do not have administrative access.');
    }
}
