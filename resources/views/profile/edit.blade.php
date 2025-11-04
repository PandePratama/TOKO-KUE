@include('layouts.partials.navbar')

@extends('layouts.main')

@section('content')
<div class="container py-5">
    <div class="row">
        <!-- Sidebar Profil -->
        @include('profile.layout.sidebar')

        <!-- Form Edit Profil -->
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header" style="background-color:#5f89a2; color:white;">
                    <h5 class="mb-0"><i class="bi bi-pencil-square"></i> Edit Profil</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ old('name', $user->name) }}" required>
                            @error('name')
                            <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Alamat Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ old('email', $user->email) }}" required>
                            @error('email')
                            <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="phone_number" class="form-label">Nomor Telepon</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number"
                                value="{{ old('phone_number', $user->phone_number) }}">
                            @error('phone_number')
                            <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr>

                        <div class="mb-3">
                            <label for="password" class="form-label">Kata Sandi Baru (Opsional)</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Kosongkan jika tidak ingin mengganti">
                            @error('password')
                            <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('profile.index') }}" class="btn btn-secondary me-2">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection