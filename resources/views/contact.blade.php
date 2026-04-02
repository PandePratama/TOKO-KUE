@extends('layouts.main')
@section('title', 'Hubungi Kami - JajanSnack')
@section('content')
<section class="contact-section py-5" style="background-color: #faf7f5;">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-uppercase" style="color: #7f574c;">Hubungi Kami</h2>
            <p class="text-muted">Kami dengan senang hati menerima pertanyaan, kritik, dan saran Anda.</p>
        </div>

        <div class="row g-4">
            {{-- Informasi Kontak --}}
            <div class="col-md-5">
                <div class="p-4 bg-white shadow-sm rounded-4 h-100">
                    <h4 class="fw-bold mb-3" style="color: #7f574c;">Informasi Kontak</h4>
                    <ul class="list-unstyled fs-6">
                        <li class="mb-3">
                            <i class="bi bi-geo-alt-fill me-2" style="color:#7f574c;"></i>
                            <strong>Alamat:</strong> Jl. Raya Negara, no.11, Sading, Badung, Bali 80351
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-telephone-fill me-2" style="color:#7f574c;"></i>
                            <strong>Telepon:</strong> +62 812-3456-7890
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-envelope-fill me-2" style="color:#7f574c;"></i>
                            <strong>Email:</strong> support@jajansnack.com
                        </li>
                        <li>
                            <i class="bi bi-clock-fill me-2" style="color:#7f574c;"></i>
                            <strong>Jam Operasional:</strong> Senin – Sabtu, 08.00 – 18.00 WITA
                        </li>
                    </ul>

                    <div class="mt-4">
                        <h5 class="fw-semibold mb-3" style="color: #7f574c;">Ikuti Kami</h5>
                        <div class="d-flex gap-3">
                            <a href="#" class="fs-4" style="color:#7f574c;"><i class="bi bi-facebook"></i></a>
                            <a href="https://www.instagram.com/_sariinten/" class="fs-4" style="color:#7f574c;"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="fs-4" style="color:#7f574c;"><i class="bi bi-whatsapp"></i></a>
                            <a href="#" class="fs-4" style="color:#7f574c;"><i class="bi bi-tiktok"></i></a>
                        </div>
                    </div>

                    <div class="mt-4 rounded-4 overflow-hidden shadow-sm">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3944.8976672899644!2d115.1949698741548!3d-8.605823106406755!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd23ed155021bcb%3A0xdb46604dbe4d02f4!2sJl.%20Raya%20Negara%20No.11%2C%20Sading%2C%20Kec.%20Mengwi%2C%20Kabupaten%20Badung%2C%20Bali%2080115!5e0!3m2!1sid!2sid!4v1762148506699!5m2!1sid!2sid"
                            width="100%" height="200" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>

            {{-- Form Kirim Pesan --}}
            <div class="col-md-7">
                <div class="p-4 bg-white shadow-sm rounded-4">
                    <h4 class="fw-bold mb-4" style="color: #7f574c;">Kirim Pesan</h4>

                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
                        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    <form action="{{ route('contact.send') }}" method="POST">
                        @csrf

                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" name="name" value="{{ old('name') }}"
                                    class="form-control rounded-3 @error('name') is-invalid @enderror"
                                    placeholder="Nama Anda" required>
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label fw-semibold">Alamat Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" value="{{ old('email') }}"
                                    class="form-control rounded-3 @error('email') is-invalid @enderror"
                                    placeholder="email@contoh.com" required>
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold">Subjek <span class="text-danger">*</span></label>
                                <input type="text" name="subject" value="{{ old('subject') }}"
                                    class="form-control rounded-3 @error('subject') is-invalid @enderror"
                                    placeholder="Topik pertanyaan Anda" required>
                                @error('subject')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold">Pesan <span class="text-danger">*</span></label>
                                <textarea name="message" rows="6"
                                    class="form-control rounded-3 @error('message') is-invalid @enderror"
                                    placeholder="Tulis pesan Anda di sini..." required>{{ old('message') }}</textarea>
                                @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn text-white rounded-pill px-5 py-2"
                                    style="background: linear-gradient(135deg, #7f574c, #b45309);">
                                    <i class="bi bi-send me-2"></i>Kirim Pesan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection