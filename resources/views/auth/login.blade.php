@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center vh-100 align-items-center">
        <div class="col-md-12">
            <div class="row justify-content-center vh-100">
            <div class="col-lg-6 col-md-6 d-none d-md-block" style="background-image: url('../assets/images/bh.png'); background-position: center; background-size: cover;">
                    <div class="bg-primary row p-3 align-items-center mt-5">
                        <h5 class="font-weight-bold text-white text-center">
                        <i class="fas fa-home fa-xl mr-3">
                        </i>
                        Welcome to BHMS</h5>
                    </div>
            </div>
                
                <div style="background-color:skyblue;" class="col-lg-6 col-md-6  px-2 py-3 vh-100 d-flex justify-content-center align-items-center">
                    <form method="POST" action="{{ route('login') }}" class="w-75">
                        @csrf
                        <div class="form-group row mb-3">
                            <label for="email" class="col-md-12 col-form-label text-md-left">{{ __('E-Mail Address') }}:</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3 ">
                            <label for="password" class="col-md-4 col-form-label text-md-left">{{ __('Password') }}:</label>

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success mr-2 col-12 mb-3">
                                   <i class="fa fa-sign-in"></i> {{ __('Login') }}
                                </button>
                                <a class="btn btn-warning text-dark col-12" href="{{ route('register') }}"><i class="fa fa-user-plus"></i> {{ __('Register') }}</a>
                                @if (Route::has('password.request'))
                                    <a class="btn " href="{{ route('password.request') }}">
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
</div>
@endsection
