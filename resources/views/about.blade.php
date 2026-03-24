@extends('layouts.main')

@section('title', 'Tentang Kami')

@section('content')
<!-- HERO SECTION -->
<section class="about-hero text-center text-white d-flex align-items-center justify-content-center">
    <div class="overlay"></div>
    <div class="container position-relative">
        <h1 class="display-5 fw-bold mb-3">Tentang Jajanan Tradisional Bali Kaliadrem</h1>
        <p class="lead">Melestarikan cita rasa Bali, dari dapur UMKM Sari Inten untuk seluruh Nusantara.</p>
    </div>
</section>

<!-- ABOUT SECTION -->
<section class="about-content py-5">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <img src="{{ asset('images/jaje.jpg') }}" alt="Jajanan Kaliadrem" class="img-fluid rounded-4 shadow-sm">
            </div>
            <div class="col-lg-6">
                <h2 class="fw-bold mb-3" style="color:#b45309;">Apa itu Kaliadrem?</h2>
                <p class="text-muted mb-4" style="text-align: justify;">
                    <strong>Kaliadrem</strong> adalah salah satu jajanan tradisional khas Bali yang memiliki rasa manis dan gurih dengan aroma khas kelapa dan gula merah.
                    Bentuknya yang unik menyerupai cincin melambangkan keutuhan dan kebersamaan masyarakat Bali dalam setiap upacara adat maupun momen keluarga.
                </p>
                <p class="text-muted" style="text-align: justify;">
                    Dalam proses pembuatannya, Kaliadrem menggunakan bahan alami seperti tepung beras, santan, dan gula aren tanpa bahan pengawet.
                    Cita rasa klasik ini telah diwariskan turun-temurun sebagai bagian dari kekayaan kuliner lokal Bali yang patut dilestarikan.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- UMKM SECTION -->
<section class="umkm-section py-5 bg-light">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 order-lg-2">
                <img src="{{ asset('images/ruko.jpg') }}" alt="UMKM Sari Inten" class="img-fluid rounded-4 shadow-sm">
            </div>
            <div class="col-lg-6 order-lg-1">
                <h2 class="fw-bold mb-3" style="color:#b45309;">Tentang UMKM Sari Inten</h2>
                <p class="text-muted mb-4" style="text-align: justify;">
                    <strong>UMKM Sari Inten</strong> adalah pelaku usaha lokal yang berkomitmen menghadirkan jajanan tradisional Bali dengan cita rasa otentik namun tetap higienis dan modern dalam kemasan.
                    Berdiri sejak tahun 2015 di daerah Gianyar, Bali, Sari Inten terus berkembang menjadi salah satu produsen Kaliadrem yang dipercaya oleh masyarakat lokal maupun wisatawan.
                </p>
                <p class="text-muted" style="text-align: justify;">
                    Dengan semangat *“Ngajegang Warisan Leluhur”* (menjaga warisan leluhur), Sari Inten tidak hanya menjual jajanan,
                    tetapi juga memperkenalkan kekayaan budaya Bali kepada generasi muda dan pasar nasional.
                </p>

                <div class="mt-4">
                    <a href="{{ url('/shop') }}" class="btn btn-success rounded-pill px-4 py-2">
                        <i class="bi bi-basket2 me-2"></i> Belanja Produk Kami
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- VALUE SECTION -->
<section class="py-5 text-center">
    <div class="container">
        <h3 class="fw-bold mb-4" style="color:#b45309;">Nilai dan Komitmen Kami</h3>
        <div class="row justify-content-center g-4">
            <div class="col-md-4">
                <div class="p-4 bg-white rounded-4 shadow-sm h-100">
                    <i class="bi bi-heart-fill text-danger fs-1 mb-3"></i>
                    <h5 class="fw-semibold mb-2">Cinta Budaya Lokal</h5>
                    <p class="text-muted mb-0">Kami menjaga keaslian rasa dan tradisi jajanan Bali agar tetap lestari.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 bg-white rounded-4 shadow-sm h-100">
                    <i class="bi bi-emoji-smile-fill text-warning fs-1 mb-3"></i>
                    <h5 class="fw-semibold mb-2">Kualitas Terbaik</h5>
                    <p class="text-muted mb-0">Menggunakan bahan alami berkualitas dan diproses secara higienis.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 bg-white rounded-4 shadow-sm h-100">
                    <i class="bi bi-people-fill text-success fs-1 mb-3"></i>
                    <h5 class="fw-semibold mb-2">Dari UMKM untuk Negeri</h5>
                    <p class="text-muted mb-0">Mendukung ekonomi lokal dan memberdayakan masyarakat sekitar.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- STYLE -->
<style>
    .about-hero {
        position: relative;
        background: url("{{ asset('images/jaje.jpg') }}") center center/cover no-repeat;
        height: 60vh;
    }

    .about-hero .overlay {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.4);
    }
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

@endsection