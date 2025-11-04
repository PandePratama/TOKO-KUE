{{-- resources/views/profile/layout/sidebar.blade.php --}}
<div class="col-md-4">
    <div class="card shadow-sm">
        <div class="card-body text-center" style="background-color:#5f89a2; color:white; border-radius:8px;">
            <img src="{{ asset('images/avatar.svg') }}" class="rounded-circle mb-3" alt="Profile Picture" width="100">
            <p class="fw-bold">{{ $user->name }}</p>
            <h6>{{ $user->email }}</h6>
            <p class="mb-1">{{ $user->phone_number ?? 'No phone' }}</p>
        </div>

        <div class="list-group list-group-flush">
            <a href="{{ route('profile.edit') }}"
                class="list-group-item list-group-item-action {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
                <i class="bi bi-person"></i> Edit Profile
            </a>
            <a href="{{ route('profile.orders') }}" class="list-group-item list-group-item-action">
                <i class="bi bi-bag"></i> Pesanan
            </a>
            <a href="#" class="list-group-item list-group-item-action">
                <i class="bi bi-question-circle"></i> Pusat Bantuan
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="list-group-item list-group-item-action text-danger">
                    <i class="bi bi-box-arrow-right"></i> Sign Out
                </button>
            </form>
        </div>
    </div>
</div>