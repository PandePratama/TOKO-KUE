<div class="col-lg-3 col-md-4 mb-4">
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

        <!-- Header Profile -->
        <div class="text-center p-4 text-white"
            style="background: linear-gradient(135deg, var(--primary,#7f574c), var(--accent,#b45309));">

            {{-- Avatar initials --}}
            @php
            $initials = collect(explode(' ', $user->name))
            ->map(fn($w) => strtoupper(substr($w,0,1)))
            ->take(2)
            ->implode('');
            @endphp
            <div class="rounded-circle border border-3 border-white shadow-sm d-inline-flex
                        align-items-center justify-content-center mb-3"
                style="width:72px;height:72px;background:rgba(255,255,255,.2);
                        font-size:1.5rem;font-weight:700;letter-spacing:1px;">
                {{ $initials }}
            </div>

            <h6 class="fw-bold mb-1">{{ $user->name }}</h6>
            <small class="opacity-75">{{ $user->email }}</small>
            @if($user->phone_number)
            <div class="mt-1" style="font-size:.8rem;opacity:.8;">
                <i class="bi bi-telephone me-1"></i>{{ $user->phone_number }}
            </div>
            @endif
        </div>

        <!-- Menu -->
        <div class="list-group list-group-flush">

            <a href="{{ route('profile.edit') }}"
                class="list-group-item list-group-item-action d-flex align-items-center gap-2 py-3
                      {{ request()->routeIs('profile.edit') ? 'active fw-semibold' : '' }}"
                style="{{ request()->routeIs('profile.edit') ? 'background:var(--surface-soft,#f7efe8);color:var(--primary,#7f574c);border-left:3px solid var(--primary,#7f574c);' : '' }}">
                <i class="bi bi-person-circle"></i> Edit Profil
            </a>

            <a href="{{ route('profile.orders') }}"
                class="list-group-item list-group-item-action d-flex align-items-center gap-2 py-3
                      {{ request()->routeIs('profile.orders') ? 'active fw-semibold' : '' }}"
                style="{{ request()->routeIs('profile.orders') ? 'background:var(--surface-soft,#f7efe8);color:var(--primary,#7f574c);border-left:3px solid var(--primary,#7f574c);' : '' }}">
                <i class="bi bi-bag-heart"></i> Pesanan Saya
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="list-group-item list-group-item-action d-flex align-items-center gap-2 py-3 text-danger border-0 w-100 bg-transparent">
                    <i class="bi bi-box-arrow-right"></i> Keluar
                </button>
            </form>
        </div>
    </div>
</div>