@include('layouts.partials.navbar')

@extends('layouts.main')

@section('content')
<div class="container py-5">
    <div class="row">
        <!-- Sidebar Profil -->
        @include('profile.layout.sidebar')

        <!-- Konten Kanan -->
        <div class="col-md-8 d-flex justify-content-center align-items-center">
            <div class="text-center">
                <img src="https://cdn-icons-png.flaticon.com/512/748/748113.png"
                    alt="Empty" width="150" class="mb-3">
                <p class="text-muted">Gunakan menu di sebelah kiri untuk mengelola profil dan melihat pesanan Anda</p>
            </div>
        </div>
    </div>
</div>
@endsection