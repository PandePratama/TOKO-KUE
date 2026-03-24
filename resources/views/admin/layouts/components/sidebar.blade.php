<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/admin">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-store"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin</div>
    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item active">
        <a class="nav-link" href="/admin">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <!-- <li class="nav-item">
        <a class="nav-link" href="/">
            <i class="fas fa-home"></i>
            <span>Halaman Utama</span>
        </a>
    </li> -->

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.products.index') }}">
            <i class="fas fa-box"></i>
            <span>Produk</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.customers.index') }}">
            <i class="fas fa-users"></i>
            <span>Data Customer</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.orders.index') }}">
            <i class="fas fa-shopping-cart"></i>
            <span>Orders</span>
        </a>
    </li>
    <li class="nav-item {{ request()->routeIs('admin.pickup-dates.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.pickup-dates.index') }}">
            <i class="fas fa-calendar-alt"></i>
            <span>Pickup Dates</span>
        </a>
    </li>
</ul>