<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="Admin Dashboard for The Style Edit" />
        <meta name="author" content="" />
        <title>Dashboard - The Style Edit Admin</title>
        
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="{{asset('admin-assets/css/styles.css')}}" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    </head>
    <body class="sb-nav-fixed">
        
        <!-- Top Navbar -->
        <nav class="sb-topnav navbar navbar-expand navbar-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-4" href="{{route('backend.dashboard')}}">Style Edit</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0 text-white" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control bg-light border-0" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            
            <!-- Navbar User Menu-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user-circle fa-lg fa-fw"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2" aria-labelledby="navbarDropdown">
                        <li><span class="dropdown-item fw-bold text-primary">{{ Auth::user()->name }}</span></li>
                        <li><a class="dropdown-item" href="#!">Profile</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li>
                            <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt me-2"></i> {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>

        <div id="layoutSidenav">
            <!-- Sidebar Navigation -->
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav mt-3">
                            
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="{{route('backend.dashboard') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                                Dashboard
                            </a>
                            
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link" href="{{route('backend.items.index') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-box-open"></i></div>
                                Items
                            </a>
                            <a class="nav-link" href="{{route('backend.categories.index') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tags"></i></div>
                                Categories
                            </a>
                            <a class="nav-link" href="{{route('backend.payments.index') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-credit-card"></i></div>
                                Payments
                            </a>
                            
                            @if (Auth::check() && Auth::user()->role == 'Super Admin')
                                <a class="nav-link" href="{{route('backend.users.index') }}">
                                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                    Users
                                </a>
                            @endif
                            
                            <a class="nav-link" href="{{ route('backend.orders') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
                                Orders
                            </a>
                            
                        </div>
                    </div>
                    
                    <div class="sb-sidenav-footer text-white-50" style="background-color: rgba(0,0,0,0.2);">
                        <div class="small">Logged in as:</div>
                        <span class="text-white fw-bold">{{ Auth::user()->role ?? 'Admin' }}</span>
                    </div>
                </nav>
            </div>
            
            <!-- Main Content Area -->
            <div id="layoutSidenav_content">
                <main class="p-4">
                    @yield('content')
                </main>
                
                <!-- Footer -->
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; The Style Edit 2026</div>
                            <div>
                                <a href="#" class="text-decoration-none text-muted me-2">Privacy Policy</a>
                                &middot;
                                <a href="#" class="text-decoration-none text-muted ms-2">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{asset('admin-assets/js/scripts.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        @yield('script')
    </body>
</html>