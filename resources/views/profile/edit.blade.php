@extends('layouts.main')

@section('content')
<div class="container py-5">
    <div class="row">

        @include('profile.layout.sidebar')

        <div class="col-lg-9 col-md-8">
            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-header text-white rounded-top-4"
                    style="background: linear-gradient(135deg, var(--primary,#7f574c), var(--accent,#b45309));">
                    <h5 class="mb-0 fw-bold">
                        <i class="bi bi-pencil-square me-2"></i>Edit Profil
                    </h5>
                </div>

                <div class="card-body p-4">

                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show rounded-3 mb-4" role="alert">
                        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Informasi Akun --}}
                        <h6 class="fw-bold text-muted text-uppercase small mb-3 mt-1"
                            style="letter-spacing:.05em;">Informasi Akun</h6>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Lengkap</label>
                            <input type="text" name="name"
                                value="{{ old('name', $user->name) }}"
                                class="form-control rounded-3 @error('name') is-invalid @enderror" required>
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Alamat Email</label>
                            <input type="email" name="email"
                                value="{{ old('email', $user->email) }}"
                                class="form-control rounded-3 @error('email') is-invalid @enderror" required>
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Nomor Telepon</label>
                            <div class="input-group">
                                <span class="input-group-text rounded-start-3">
                                    <i class="bi bi-telephone"></i>
                                </span>
                                <input type="tel" name="phone_number"
                                    value="{{ old('phone_number', $user->phone_number) }}"
                                    class="form-control rounded-end-3 @error('phone_number') is-invalid @enderror"
                                    placeholder="08xxxxxxxxxx">
                                @error('phone_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <hr class="my-4">

                        {{-- Keamanan --}}
                        <h6 class="fw-bold text-muted text-uppercase small mb-3"
                            style="letter-spacing:.05em;">Keamanan</h6>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Kata Sandi Baru
                                <span class="text-muted fw-normal">(Opsional)</span>
                            </label>
                            <input type="password" name="password"
                                class="form-control rounded-3 @error('password') is-invalid @enderror"
                                placeholder="Kosongkan jika tidak ingin mengganti">
                            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Konfirmasi Kata Sandi Baru</label>
                            <input type="password" name="password_confirmation"
                                class="form-control rounded-3"
                                placeholder="Ulangi kata sandi baru">
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn text-white rounded-pill px-4"
                                style="background: linear-gradient(135deg, var(--primary,#7f574c), var(--accent,#b45309));">
                                <i class="bi bi-check-lg me-1"></i> Simpan Perubahan
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>

    </div>
</div>
@endsection