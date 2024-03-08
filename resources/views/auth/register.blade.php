@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center vh-100 align-items-center">
        <div class="col-md-12">
            <div class="row justify-content-center vh-100">
                <!-- <div class="col-lg-6 col-md-6 border" style="background-image: url({{ asset('../assets/images/bh_logo.jpg') }}); background-position: center; background-size: cover">
                    <div>
                        Welcome to BHMS
                    </div>
                </div> -->
                
                <div style="background-color:skyblue;" class="col-lg-9 col-md-6 border px-2 py-3 vh-100 d-flex justify-content-center align-items-center">
                    <!-- Form Div -->
                    <form method="POST" action="{{ route('register') }}" class="w-75">
                        @csrf

                        <!-- First Row -->
                        <div class="row">
                            <div class="col-md-6">
                                <!-- First Name -->
                                <div class="form-group">
                                    <label for="first_name" class="col-form-label">{{ __('First Name') }}:</label>
                                    <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Middle Name -->
                                <div class="form-group">
                                    <label for="middle_name" class="col-form-label">{{ __('Middle Name') }}:</label>
                                    <input id="middle_name" type="text" class="form-control @error('middle_name') is-invalid @enderror" name="middle_name" value="{{ old('middle_name') }}" autocomplete="middle_name">
                                </div>
                            </div>
                        </div>

                        <!-- Second Row -->
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Last Name -->
                                <div class="form-group">
                                    <label for="last_name" class="col-form-label">{{ __('Last Name') }}:</label>
                                    <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Gender -->
                                <div class="form-group">
                                    <label for="gender" class="col-form-label">{{ __('Gender') }}:</label>
                                    <select id="gender" class="form-control @error('gender') is-invalid @enderror" name="gender" required>
                                        <option value="">Select Gender</option>
                                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Third Row -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user_type" class="col-form-label">{{ __('User Type') }}:</label>
                                    <select id="user_type" class="form-control @error('user_type') is-invalid @enderror" name="user_type" required>
                                        <option value="">Select User Type</option>
                                        <option value="student">Student</option>
                                        <option value="homeowner" >Homeowner</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Email -->
                                <div class="form-group">
                                    <label for="email" class="col-form-label">{{ __('E-Mail Address') }}:</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                </div>
                            </div>
                        </div>

                        <!-- Fourth Row -->
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Password -->
                                <div class="form-group">
                                    <label for="password" class="col-form-label">{{ __('Password') }}:</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Confirm Password -->
                                <div class="form-group">
                                    <label for="password-confirm" class="col-form-label">{{ __('Confirm Password') }}:</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                        </div>
                        <!-- Register Button -->
                        <div class="form-group row">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary col-12">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                        <!-- Login Link -->
                        <div class="form-group row mt-3">
                            <div class="col-md-12 text-center">
                                <a class="btn col-12 btn-warning" href="{{ route('login') }}">
                                    {{ __('Already have an account? Login') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
