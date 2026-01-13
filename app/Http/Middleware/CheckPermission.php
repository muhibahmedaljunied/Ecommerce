<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPermission
{
    public function handle(Request $request, Closure $next, $permission)
    {
        $user = $request->user();

        if (!$user) {
            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }
            return redirect('/customer/login');
        }

        if ($user->hasPermission($permission) || $user->hasRole('admin')) {
            return $next($request);
        }

        if ($request->expectsJson() || $request->is('api/*')) {
            return response()->json(['message' => 'Forbidden. Missing permission: ' . $permission], 403);
        }

        return redirect('/')->with('error', 'Forbidden. Missing permission: ' . $permission);
    }
}
