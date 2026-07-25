@extends('layouts.front')

@section('content')
<div class="container my-5 py-4">
    <div class="row justify-content-center">
        <!-- Form အကွက်တွေများတဲ့အတွက် Login ထက် နည်းနည်းပိုကျယ်တဲ့ col-lg-6 ကို သုံးထားပါသည် -->
        <div class="col-md-8 col-lg-6"> 
            
            <!-- Shop Branding Area -->
            <div class="text-center mb-4">
                <h2 class="fw-bold text-primary">Hein<span class="text-warning">Shop</span></h2>
                <p class="text-muted">Create your account to start shopping!</p>
            </div>

            <!-- Register Card -->
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-4 p-md-5">
                    <!-- ပုံတင်ဖို့အတွက် enctype="multipart/form-data" ကို မူလအတိုင်း ထားရှိပါသည် -->
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Name and Phone Row -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label fw-bold">{{ __('Name') }}</label>
                                <input id="name" type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="John Doe">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label fw-bold">{{ __('Phone') }}</label>
                                <input id="phone" type="text" class="form-control form-control-lg @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" placeholder="09xxxxxxxxx">

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Email Input -->
                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="email@example.com">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Profile Image Input -->
                        <div class="mb-3">
                            <label for="profile" class="form-label fw-bold">{{ __('Profile Image') }}</label>
                            <input id="profile" type="file" class="form-control form-control-lg @error('profile') is-invalid @enderror" name="profile" value="{{ old('profile') }}" required autocomplete="profile">

                            @error('profile')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Password and Confirm Password Row -->
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="password" class="form-label fw-bold">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Create password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="password-confirm" class="form-label fw-bold">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password" class="form-control form-control-lg" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm password">
                            </div>
                        </div>

                        <!-- Register Button (Full Width) -->
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary btn-lg fw-bold shadow-sm">
                                {{ __('Create Account') }}
                            </button>
                        </div>

                        <!-- Login Link -->
                        @if (Route::has('login'))
                        <div class="text-center mt-4">
                            <p class="mb-0 text-muted">Already have an account? 
                                <a href="{{ route('login') }}" class="text-decoration-none fw-bold">{{ __('Login Here') }}</a>
                            </p>
                        </div>
                        @endif

                    </form>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection