<div class="col-lg-3 col-md-4 mb-4">
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

        <!-- Header Profile -->
        <div class="text-center p-4 text-white" style="background: linear-gradient(135deg,#5f89a2,#3f6b85);">
            <img src="{{ asset('images/avatar.svg') }}"
                class="rounded-circle border border-3 border-white shadow-sm mb-3"
                width="90">

            <h6 class="fw-bold mb-1">{{ $user->name }}</h6>
            <small>{{ $user->email }}</small>
            <div class="mt-2 small">
                {{ $user->phone_number ?? 'No phone number' }}
            </div>
        </div>

        <!-- Menu -->
        <div class="list-group list-group-flush">

            <a href="{{ route('profile.edit') }}"
                class="list-group-item list-group-item-action {{ request()->routeIs('profile.edit') ? 'active fw-bold' : '' }}">
                <i class="bi bi-person me-2"></i> Edit Profile
            </a>

            <a href="{{ route('profile.orders') }}"
                class="list-group-item list-group-item-action {{ request()->routeIs('profile.orders') ? 'active fw-bold' : '' }}">
                <i class="bi bi-bag me-2"></i> Pesanan Saya
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="list-group-item list-group-item-action text-danger">
                    <i class="bi bi-box-arrow-right me-2"></i> Sign Out
                </button>
            </form>
        </div>
    </div>
</div>