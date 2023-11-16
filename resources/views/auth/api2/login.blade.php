@extends('layouts.app')

@section('content')

<div class="container-fluid">
<form method="POST" action="{{ route('login-api') }}">
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
                            <div class="card-sigin">
                            <div class="card-header">{{ __('Login') }}</div>

                                <div class="mb-5 d-flex"> <a href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/favicon.png')}}" class="sign-favicon ht-40" alt="logo"></a>
                                    <h1 class="main-logo1 ml-1 mr-0 my-auto tx-28">Va<span>le</span>x</h1>
                                </div>
                                <div class="card-sigin">
                                    <div class="main-signup-header">
                                        <h2>Welcome back!</h2>
                                        <h5 class="font-weight-semibold mb-4">Please sign in to continue.</h5>
                                        <form method="POST" action="{{ route('login') }}">
                                            @csrf

                                            <div class="form-group row">
                                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                                <div class="col-md-10">
                                                    <input id="email" type="email" class="form-control is-invalid " name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                                
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                                <div class="col-md-10">
                                                    <input id="password" type="password" class="form-control  is-invalid " name="password" required autocomplete="current-password">

                                                   
                                                </div>
                                            </div>

                               

                                            <div class="form-group row mb-0">
                                                <div class="col-md-8 ">
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
                                        <div class="main-signin-footer mt-5">
                                            <p><a href="">Forgot password?</a></p>
                                            <p>Don't have an account? <a href="{{ url('/' . $page='signup') }}">Create an Account</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- End -->
            </div>
        </div><!-- End -->
    </div>

</form>
</div>

@endsection