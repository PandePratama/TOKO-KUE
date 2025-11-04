@extends('layouts.main')
@include('layouts.partials.navbar')

@section('content')
<section class="contact-section py-5" style="background-color: #faf7f5;">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-uppercase" style="color: #7f574c;">Hubungi Kami</h2>
            <p class="text-muted">Kami dengan senang hati menerima pertanyaan, kritik, dan saran Anda.</p>
        </div>

        <div class="row align-items-center">
            {{-- Informasi Kontak --}}
            <div class="col-md-6 mb-4">
                <div class="p-4 bg-white shadow-sm rounded-4 h-100">
                    <h4 class="fw-bold mb-3" style="color: #7f574c;">Informasi Kontak</h4>
                    <ul class="list-unstyled fs-6">
                        <li class="mb-3">
                            <i class="bi bi-geo-alt-fill text-success me-2"></i>
                            <strong>Alamat:</strong> Jl. Raya Negara, no.11, Sading, Badung, Bali, Indonesia 80351
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-telephone-fill text-success me-2"></i>
                            <strong>Telepon:</strong> +62 812-3456-7890
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-envelope-fill text-success me-2"></i>
                            <strong>Email:</strong> support@jajansnack.com
                        </li>
                        <li>
                            <i class="bi bi-clock-fill text-success me-2"></i>
                            <strong>Jam Operasional:</strong> Senin – Sabtu, 08.00 – 18.00 WITA
                        </li>
                    </ul>

                    <div class="mt-4">
                        <h5 class="fw-semibold mb-3" style="color: #7f574c;">Ikuti Kami</h5>
                        <div class="d-flex gap-3">
                            <a href="#" class="text-success fs-4"><i class="bi bi-facebook"></i></a>
                            <a href="https://www.instagram.com/_sariinten/" class="text-success fs-4"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="text-success fs-4"><i class="bi bi-whatsapp"></i></a>
                            <a href="#" class="text-success fs-4"><i class="bi bi-tiktok"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Gambar & Map --}}
            <div class="col-md-6">
                <div class="rounded-4 overflow-hidden shadow-sm">
                    <img src="{{ asset('images/ruko.jpg') }}" alt="Toko JajanSnack"
                        class="img-fluid w-100" style="object-fit: cover; height: 350px;">
                </div>
                <div class="mt-4 rounded-4 overflow-hidden shadow-sm">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3944.8976672899644!2d115.1949698741548!3d-8.605823106406755!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd23ed155021bcb%3A0xdb46604dbe4d02f4!2sJl.%20Raya%20Negara%20No.11%2C%20Sading%2C%20Kec.%20Mengwi%2C%20Kabupaten%20Badung%2C%20Bali%2080115!5e0!3m2!1sid!2sid!4v1762148506699!5m2!1sid!2sid" width="1005" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Sedikit sentuhan footer-like info --}}
<section class="py-4 text-center text-white" style="background-color: #7f574c;">
    <p class="mb-0 fw-semibold">© {{ date('Y') }} JajanSnack — Jajanan Tradisional Bali dengan Sentuhan Modern.</p>
</section>
@endsection

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>