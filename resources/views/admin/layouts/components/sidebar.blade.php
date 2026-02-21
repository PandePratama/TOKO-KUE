<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center"
        href="{{ route('admin.dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-store"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin</div>
    </a>

    <hr class="sidebar-divider my-0">

    <!-- Dashboard -->
    <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <!-- Produk -->
    <li class="nav-item {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.products.index') }}">
            <i class="fas fa-box"></i>
            <span>Produk</span>
        </a>
    </li>

    <!-- Customer -->
    <li class="nav-item {{ request()->routeIs('admin.customers.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.customers.index') }}">
            <i class="fas fa-users"></i>
            <span>Data Customer</span>
        </a>
    </li>

    <!-- Orders -->
    <li class="nav-item {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.orders.index') }}">
            <i class="fas fa-shopping-cart"></i>
            <span>Orders</span>
        </a>
    </li>

    <!-- Pickup Dates -->
    <li class="nav-item {{ request()->routeIs('admin.pickup-dates.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.pickup-dates.index') }}">
            <i class="fas fa-calendar-alt"></i>
            <span>Pickup Dates</span>
        </a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

</ul>