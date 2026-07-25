<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="HeinShop - Elevate Your Style" />
        <meta name="author" content="HeinShop" />
        <title>HeinShop</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{asset('front-assets/css/styles.css')}}" rel="stylesheet" />
        
        <!-- Custom CSS for Extra Tweaks (Optional) -->
        <style>
            body {
                background-color: #f8f9fa; /* အောက်ခံအရောင်ကို မီးခိုးနုရောင်လေးပြောင်းထားပါသည် */
            }
            .navbar-brand {
                font-size: 1.5rem;
                letter-spacing: 0.5px;
            }
            .nav-link {
                font-weight: 500;
                transition: color 0.3s ease;
            }
            .nav-link:hover {
                color: #0d6efd !important; /* Hover လုပ်ရင် အပြာရောင်ပြောင်းရန် */
            }
        </style>
    </head>
    <body>
        <!-- Navigation (Sticky, White Background, Shadow) -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm py-3">
            <div class="container px-4 px-lg-5">
                <!-- Brand Name with Colors -->
                <a class="navbar-brand fw-bold" href="{{ route('shop') }}">
                    <span class="text-primary">Hein</span><span class="text-warning">Shop</span>
                </a>
                
                <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="{{ route('shop') }}">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Categories</a>
                            <ul class="dropdown-menu border-0 shadow" aria-labelledby="navbarDropdown">
                                @php
                                    $categories = \App\Models\Category::all();
                                @endphp
                                @foreach ($categories as $category)
                                    <li><a class="dropdown-item py-2" href="{{ route('item.categories',$category->id) }}">{{$category->name}}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                    
                    <div class="d-flex align-items-center">
                        <!-- Cart Button (Rounded Pill) -->
                        <a href="{{ route('item-carts.carts') }}" class="btn btn-primary rounded-pill px-4 me-3 d-flex align-items-center text-white fw-bold">
                            <i class="bi-cart-fill me-2"></i>
                            Cart
                            <span class="badge bg-light text-primary ms-2 rounded-pill" id="count_item">0</span>
                        </a>

                        <!-- Auth Links -->
                        @guest
                            <a href="/login" class="btn btn-outline-primary rounded-pill px-4 me-2 fw-bold">Login</a>
                            <a href="/register" class="btn btn-primary rounded-pill px-4 fw-bold">Register</a>
                        @else
                            <div class="dropdown">
                                <a href="#" class="text-decoration-none text-dark dropdown-toggle fw-bold d-flex align-items-center" data-bs-toggle="dropdown">
                                    <i class="bi-person-circle fs-5 me-2 text-primary"></i>
                                    {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end border-0 shadow mt-2">
                                    @if(Auth::user()->role == 'User')
                                        <li><a href="" class="dropdown-item py-2"><i class="bi-person me-2"></i>Profile</a></li>
                                    @else
                                        <li><a href="/backend" class="dropdown-item py-2"><i class="bi-speedometer2 me-2"></i>Admin Panel</a></li>
                                    @endif
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item py-2 text-danger" href="{{ route('logout') }}"
                                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="bi-box-arrow-right me-2"></i>{{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="min-vh-100">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="py-4 mt-auto hero-header">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center flex-column flex-md-row">
                    <p class="m-0 text-white">&copy; 2026 <strong>HeinShop</strong>. All rights reserved.</p>
                    <div class="mt-3 mt-md-0">
                        <a href="#" class="text-white me-3 text-decoration-none"><i class="bi-facebook fs-5"></i></a>
                        <a href="#" class="text-white me-3 text-decoration-none"><i class="bi-instagram fs-5"></i></a>
                        <a href="#" class="text-white text-decoration-none"><i class="bi-twitter fs-5"></i></a>
                    </div>
                </div>
            </div>
        </footer>

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{asset('front-assets/js/scripts.js')}}"></script>
        <script src="{{ asset('front-assets/js/add_to_cart.js') }}"></script>
        
        @yield('script')
    </body>
</html>