@extends('layouts.main')

@section('content')
<div class="container py-5">
    <div class="row">

        @include('profile.layout.sidebar')

        <div class="col-lg-9 col-md-8">
            <div class="card border-0 shadow-sm rounded-4 p-5 text-center">
                <img src="https://cdn-icons-png.flaticon.com/512/748/748113.png"
                    width="130" class="mb-4">

                <h4 class="fw-bold mb-3">Selamat Datang, {{ $user->name }} 👋</h4>

                <p class="text-muted">
                    Gunakan menu di sebelah kiri untuk mengelola profil dan melihat riwayat pesanan Anda.
                </p>
            </div>
        </div>

    </div>
</div>
@endsection