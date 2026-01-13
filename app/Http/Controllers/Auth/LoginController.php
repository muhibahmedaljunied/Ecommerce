<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {


        $this->middleware('guest')->except('logout');
    }

    /**
     * After authentication hook.
     * If this login attempt originated from an admin intent, ensure the user is an admin.
     */
    /**
     * Determine whether this login attempt should be treated as an admin login.
     */
    protected function isAdminAttempt(Request $request)
    {
        // explicit admin flags
        if ($request->query('admin') || $request->input('admin') || session('login_intent') == 'admin') {
            return true;
        }

        // If the intended URL (set by redirect()->guest) points outside /customer, treat as admin intent
        $intended = session('url.intended');
        if ($intended) {
            $path = parse_url($intended, PHP_URL_PATH) ?: $intended;
            if (! str_starts_with($path, '/customer')) {
                return true;
            }
        }

        // Check previous url as a fallback
        $previous = url()->previous();
        if ($previous) {
            $path = parse_url($previous, PHP_URL_PATH) ?: $previous;
            if (! str_starts_with($path, '/customer') && $path !== '/login') {
                return true;
            }
        }

        return false;
    }

    protected function authenticated(Request $request, $user)
    {
        $isAdminAttempt = $this->isAdminAttempt($request);
        if ($isAdminAttempt) {
            $isAdminFlag = false;
            if (method_exists($user, 'isAdmin')) {
                $isAdminFlag = (bool) $user->isAdmin();
            } else {
                $isAdminFlag = (property_exists($user, 'is_admin') && $user->is_admin) || (isset($user->is_admin) && $user->is_admin);
            }

            $hasAdminRole = method_exists($user, 'hasRole') && $user->hasRole('admin');
            $hasAccessPermission = method_exists($user, 'hasPermission') && $user->hasPermission('access-admin');

            if (! ($isAdminFlag || $hasAdminRole || $hasAccessPermission)) {
                // Prevent login into admin area for regular customers (defensive — this is a fallback)
                Auth::logout();
                return redirect()->route('login', ['admin' => 1])->withErrors(['email' => 'You are not authorized to access the admin panel.']);
            }
        }

        // clear intent when authenticated
        session()->forget('login_intent');
    }

    /**
     * Attempt to log the user in.
     * If this is an admin login attempt (admin=1) ensure the supplied email belongs to an admin before trying to authenticate.
     */
    protected function attemptLogin(Request $request)
    {
        $isAdminAttempt = $this->isAdminAttempt($request);
        if ($isAdminAttempt) {
            $email = $request->input($this->username());
            $user = \App\Models\User::where('email', $email)->first();
            if (! $user) {
                // No such user — let the normal failed login flow handle it
                return false;
            }

            $isAdminFlag = false;
            if (method_exists($user, 'isAdmin')) {
                $isAdminFlag = (bool) $user->isAdmin();
            } else {
                $isAdminFlag = (property_exists($user, 'is_admin') && $user->is_admin) || (isset($user->is_admin) && $user->is_admin);
            }
            $hasAdminRole = method_exists($user, 'hasRole') && $user->hasRole('admin');
            $hasAccessPermission = method_exists($user, 'hasPermission') && $user->hasPermission('access-admin');

            if (! ($isAdminFlag || $hasAdminRole || $hasAccessPermission)) {
                // Block logging in and set a session flag so we can return a clear error
                session()->flash('admin_login_error', 'You are not authorized to access the admin panel.');
                return false;
            }
        }

        return $this->guard()->attempt(
            $this->credentials($request), $request->filled('remember')
        );
    }

    /**
     * Customize failed login response so admin-specific message is shown when we blocked an admin login.
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        $error = session('admin_login_error') ?: trans('auth.failed');

        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors([$this->username() => $error]);
    }


}
