@extends('layouts.front')

@section('content')
<div class="container my-5 py-5">
    <div class="row justify-content-center mb-5 pb-5">
        <div class="col-md-6 col-lg-5"> <!-- Card ကို နည်းနည်းကျဉ်းပြီး အလယ်မှာ ပိုပေါ်လွင်အောင်လုပ်ထားပါသည် -->
            
            <!-- Shop Branding Area -->
            <div class="text-center mb-4">
                <h2 class="fw-bold text-primary">Hein<span class="text-warning">Shop</span></h2>
                <p class="text-muted">Welcome back! Please login to your account.</p>
            </div>

            <!-- Login Card -->
            <div class="card shadow-lg border-0 rounded-4"> <!-- အရိပ်ထည့်ပြီး ထောင့်တွေကို ဝိုင်းထားပါသည် -->
                <div class="card-body p-5">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email Input -->
                        <div class="mb-4">
                            <label for="email" class="form-label fw-bold">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter your email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Password Input -->
                        <div class="mb-4">
                            <label for="password" class="form-label fw-bold">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Enter your password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Remember Me & Forgot Password -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label text-muted" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                            
                            @if (Route::has('password.request'))
                                <a class="text-decoration-none small fw-bold" href="{{ route('password.request') }}">
                                    {{ __('Forgot Password?') }}
                                </a>
                            @endif
                        </div>

                        <!-- Login Button (Full Width) -->
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary btn-lg fw-bold shadow-sm">
                                {{ __('Login to Shop') }}
                            </button>
                        </div>

                        <!-- Register Link (Shop အတွက် မရှိမဖြစ်လိုအပ်ပါသည်) -->
                        @if (Route::has('register'))
                        <div class="text-center mt-4">
                            <p class="mb-0 text-muted">Don't have an account? 
                                <a href="{{ route('register') }}" class="text-decoration-none fw-bold">{{ __('Register Here') }}</a>
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