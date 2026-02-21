@extends('layouts.main')

@section('content')
<div class="container py-5">
    <div class="row">

        @include('profile.layout.sidebar')

        <div class="col-lg-9 col-md-8">
            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-header text-white rounded-top-4"
                    style="background: linear-gradient(135deg,#5f89a2,#3f6b85);">
                    <h5 class="mb-0">
                        <i class="bi bi-pencil-square me-2"></i>Edit Profil
                    </h5>
                </div>

                <div class="card-body p-4">

                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Nama Lengkap</label>
                            <input type="text" name="name"
                                value="{{ old('name', $user->name) }}"
                                class="form-control rounded-3" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Alamat Email</label>
                            <input type="email" name="email"
                                value="{{ old('email', $user->email) }}"
                                class="form-control rounded-3" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Nomor Telepon</label>
                            <input type="text" name="phone_number"
                                value="{{ old('phone_number', $user->phone_number) }}"
                                class="form-control rounded-3">
                        </div>

                        <hr>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                Kata Sandi Baru (Opsional)
                            </label>
                            <input type="password" name="password"
                                class="form-control rounded-3"
                                placeholder="Kosongkan jika tidak ingin mengganti">
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                
                            <button type="submit"
                                class="btn text-white rounded-3"
                                style="background-color:#5f89a2;">
                                Simpan Perubahan
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>

    </div>
</div>
@endsection