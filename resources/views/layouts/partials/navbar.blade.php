<nav class="navbar navbar-expand-lg bg-white shadow-sm py-3">
    <div class="container d-flex align-items-center justify-content-between">

        {{-- LOGO --}}
        <a class="navbar-brand fw-bold text-success fs-4 d-flex align-items-center" href="/">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="me-2" style="height: 32px;">
        </a>

        {{-- SEARCH BAR (Desktop) --}}
        <form class="d-none d-lg-flex align-items-center border rounded-pill px-3 py-1 w-50 mx-3" action="" method="GET">
            <input type="text" name="q" class="form-control border-0 bg-transparent" placeholder="Search Products">
            <button class="btn btn-link text-muted" type="submit">
                <i class="bi bi-search"></i>
            </button>
        </form>

        {{-- RIGHT SECTION (Desktop) --}}
        <ul class="navbar-nav align-items-center d-none d-lg-flex">

            {{-- Wishlist --}}
            <li class="nav-item me-3">
                <a class="nav-link text-dark position-relative" href="#">
                    <i class="bi bi-heart fs-5"></i>
                </a>
            </li>

            {{-- Cart --}}
            <li class="nav-item me-3">
                <a class="nav-link position-relative text-dark" href="{{ route('cart.index') }}">
                    <i class="bi bi-bag fs-5"></i>
                    @if(Auth::check())
                    @php $cartCount = \App\Models\Cart::where('user_id', Auth::id())->sum('quantity'); @endphp
                    @if($cartCount > 0)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
                        {{ $cartCount }}
                    </span>
                    @endif
                    @endif
                </a>
            </li>

            {{-- User --}}
            @if(Auth::check())
            <li class="nav-item dropdown me-3">
                <a class="nav-link dropdown-toggle fw-semibold text-dark" href="#" id="userDropdown" data-bs-toggle="dropdown">
                    <i class="bi bi-person fs-5 me-1"></i> {{ Auth::user()->name }}
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    <li><a class="dropdown-item" href="{{ route('profile.index') }}"><i class="bi bi-person me-2"></i>Profil</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">@csrf
                            <button type="submit" class="dropdown-item text-danger">
                                <i class="bi bi-box-arrow-right me-2"></i>Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </li>
            @else
            <li class="nav-item me-2">
                <a class="btn btn-outline-success rounded-pill px-3" href="{{ route('login') }}">Masuk</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-success rounded-pill px-3 text-white" href="{{ route('register') }}">Daftar</a>
            </li>
            @endif
        </ul>

        {{-- MOBILE ICONS --}}
        <div class="d-flex align-items-center d-lg-none">
            {{-- Search --}}
            <button class="btn btn-link text-dark me-2" type="button" data-bs-toggle="collapse" data-bs-target="#mobileSearch">
                <i class="bi bi-search fs-5"></i>
            </button>

            {{-- Cart --}}
            <a href="{{ route('cart.index') }}" class="btn btn-link text-dark position-relative me-2">
                <i class="bi bi-bag fs-5"></i>
                @if(Auth::check())
                @php $cartCount = \App\Models\Cart::where('user_id', Auth::id())->sum('quantity'); @endphp
                @if($cartCount > 0)
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
                    {{ $cartCount }}
                </span>
                @endif
                @endif
            </a>

            {{-- Hamburger Menu --}}
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar">
                <i class="bi bi-list fs-3"></i>
            </button>
        </div>
    </div>
</nav>

{{-- MOBILE SEARCH BAR --}}
<div class="collapse bg-light p-3" id="mobileSearch">
    <div class="container">
        <form class="d-flex align-items-center border rounded-pill px-3 py-1" action="" method="GET">
            <input type="text" name="q" class="form-control border-0 bg-transparent" placeholder="Search Products">
            <button class="btn btn-link text-muted" type="submit"><i class="bi bi-search"></i></button>
        </form>
    </div>
</div>

{{-- OFFCANVAS MENU (Mobile Navigation) --}}
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar">
    <div class="offcanvas-header border-bottom">
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="navbar-nav text-center">
            <li class="nav-item"><a href="{{ url('/') }}" class="nav-link fw-semibold">Home</a></li>
            <li class="nav-item"><a href="{{ url('/about') }}" class="nav-link fw-semibold">About</a></li>
            <li class="nav-item"><a href="#" class="nav-link fw-semibold">Shop</a></li>
            <li class="nav-item"><a href="{{ url('/contact') }}" class="nav-link fw-semibold">Contact</a></li>
        </ul>

        <hr>

        {{-- Auth Section --}}
        @guest
        <div class="text-center">
            <a href="{{ route('login') }}" class="btn btn-outline-success w-100 mb-2 rounded-pill">Masuk</a>
            <a href="{{ route('register') }}" class="btn btn-success w-100 rounded-pill text-white">Daftar</a>
        </div>
        @else
        <div class="text-center">
            <a href="{{ route('profile.index') }}" class="btn btn-outline-success w-100 mb-2 rounded-pill">Profil Saya</a>
            <form action="{{ route('logout') }}" method="POST">@csrf
                <button class="btn btn-danger w-100 rounded-pill">Logout</button>
            </form>
        </div>
        @endguest
    </div>
</div>

{{-- NAVIGATION MENU (Desktop) --}}
<div class="header-bottom sticky-top py-3 d-none d-lg-block" style="background-color: #7f574c;">
    <div class="container d-flex justify-content-center">
        <nav class="nav">
            <a href="{{ url('/') }}" class="nav-link text-white fw-bold mx-3">Home</a>
            <a href="{{ url('/about') }}" class="nav-link text-white fw-bold mx-3">About</a>
            <a href="#" class="nav-link text-white fw-bold mx-3">Shop</a>
            <a href="{{ url('/contact') }}" class="nav-link text-white fw-bold mx-3">Contact</a>
        </nav>
    </div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">