@extends('layouts.app')

@section('content')
<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->
<div class="container-fluid">
    <div class="row no-gutter">
        <!-- The image half -->
        <div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex bg-primary-transparent">
            <div class="row wd-100p mx-auto text-center">
                <div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p">
                    <img src="{{URL::asset('assets/img/sales.jpg')}}" class="my-auto ht-xl-80p wd-md-100p wd-xl-80p mx-auto" alt="logo">
                </div>
            </div>
        </div>
        <!-- The content half -->
        <div class="col-md-6 col-lg-6 col-xl-5 bg-white">
            <div class="login d-flex align-items-center py-2">
                <!-- Demo content-->
                <div class="container p-0">
                    <div class="row">
                        <div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
                            <div class="card-sigin admin-card">
                                    <div class="admin-badge">ADMIN</div>
                            <div class="card-header">تسجيل الدخول</div>

                                <div class="mb-5 d-flex"> <a href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/logo_muhib.jpg')}}" class="sign-favicon ht-40" alt="logo"></a>
                                    <!-- <h1 class="main-logo1 ml-1 mr-0 my-auto tx-28">Va<span>le</span>x</h1> -->
                                </div>
                                <div class="card-sigin">
                                    <div class="main-signup-header">
                                        <!-- <h2>Welcome back!</h2> -->
                                        <!-- <h5 class="font-weight-semibold mb-4">Please sign in to continue.</h5> -->
                                        <form method="POST" action="{{ route('login') }}">
                                            @csrf

                                            @php $isAdminIntent = request()->query('admin') || session('login_intent') == 'admin' || (session('url.intended') && !str_starts_with(parse_url(session('url.intended'), PHP_URL_PATH), '/customer')) || (!empty(url()->previous()) && !str_starts_with(parse_url(url()->previous(), PHP_URL_PATH), '/customer')) @endphp
                                            @if($isAdminIntent)
                                                <div class="alert alert-warning admin-alert">
                                                    <i class="fa fa-shield fa-2x text-warning mr-3" aria-hidden="true"></i>
                                                    <div>This is the <strong>admin</strong> login page. Customers cannot sign in here.</div>
                                                </div>
                                                <input type="hidden" name="admin" value="1" />
                                            @endif

                                            @if(session('admin_login_error'))
                                                <div class="alert alert-danger">{{ session('admin_login_error') }}</div>
                                            @endif

                                            <div class="form-group row">
                                                <label for="email" class="col-md-4 col-form-label text-md-right">البريد الالكتروني</label>

                                                <div class="col-md-10">
                                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror

                                            <div class="form-group row">
                                                <label for="password" class="col-md-4 col-form-label text-md-right">كلمه السر</label>

                                                <div class="col-md-10">
                                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">


                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-md-6 offset-md-4">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                        <label class="form-check-label" for="remember">
                                                           تذكر
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row mb-0">
                                                <div class="col-md-8 ">
                                                    <button type="submit" class="btn btn-primary">
                                                      تسجيل الدخول
                                                    </button>

                                                    @if (Route::has('password.request'))
                                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                                    هل نسيت كلمه السر؟
                                                    </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </form>
                                        <div class="main-signin-footer mt-5">

                                            <p>هل لديك حساب؟ <a href="{{ url('/' . $page='signup') }}">انشاء حساب</a></p>
                                        </div>

                                        @if($isAdminIntent)
                                            <div class="alert alert-info admin-alert mt-3">
                                                <i class="fa fa-info-circle fa-2x text-info mr-3" aria-hidden="true"></i>
                                                <div><strong>Not an admin?</strong> You can <a href="{{ url('/customer/login') }}">login as a customer</a> or <a href="{{ url('/customer/register') }}">register</a>.</div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- End -->
            </div>
        </div><!-- End -->
    </div>
</div>

<style>
    /* Modern admin login styles */
    body { background: linear-gradient(135deg,#0f172a 0%, #111827 50%, #1f2937 100%); color: #fff; font-family: system-ui,-apple-system,'Segoe UI',Roboto,'Helvetica Neue',Arial; }
    .login { min-height: 100vh; display:flex; align-items:center; }
    .card-sigin.admin-card { background: linear-gradient(180deg, rgba(255,255,255,0.03), rgba(255,255,255,0.02)); border-radius: 12px; padding: 28px; box-shadow: 0 8px 30px rgba(2,6,23,0.65); border: 1px solid rgba(255,255,255,0.04); color: #fff; position: relative; }
    .card-header { font-weight:700; font-size:1.25rem; color: #fff; background: transparent; border-bottom:none; padding:0 0 12px 0; }
    .admin-badge { position: absolute; top: -12px; right: -12px; background: #f59e0b; color: #111827; padding:6px 10px; border-radius: 6px; font-weight:700; box-shadow: 0 6px 18px rgba(245,158,11,0.12); }
    .card-sigin .main-signup-header { margin-top: 8px; color: #e5e7eb; }
    .form-control { background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); color: #fff; border-radius:8px; padding: 10px 12px; }
    .form-control:focus { outline: none; box-shadow: 0 0 0 3px rgba(99,102,241,0.12); border-color: rgba(99,102,241,0.8); }
    .btn-primary { background: linear-gradient(90deg,#6366f1,#8b5cf6); border: none; box-shadow: 0 8px 18px rgba(99,102,241,0.18); border-radius:10px; padding:10px 18px; color:#fff; }
    .alert { border-radius:8px; padding:12px 14px; }
    .admin-alert{ display:flex; align-items:center; gap:12px; }
    .admin-alert .fa{ font-size:1.6rem; }
    .admin-alert div{ line-height:1.25; color:#f3f4f6; }
    @media (max-width: 576px){ .admin-badge{ position: static; display:inline-block; margin-bottom:8px; } .login { padding: 20px 12px; } .card-sigin.admin-card { padding: 18px; } }
</style>

@endsection
