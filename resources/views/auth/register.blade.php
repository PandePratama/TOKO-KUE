<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - JajanSnack</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">

</head>

<body>
    <div class="register-container">
        <h2>Daftar Akun</h2>

        @if ($errors->any())
        <div class="error-messages">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('register.store') }}">
            @csrf
            <input type="text" id="name" name="name" placeholder="Nama Lengkap" value="{{ old('name') }}" required>
            <input type="email" id="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
            <input type="text" id="phone_number" , name="phone_number" placeholder="Nomor Telepon" value="{{ old('phone_number') }}" autocomplete="tel" required>
            <input type="password" id="password" name="password" placeholder="Password" required>
            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi Password" required>
            <button type="submit">Daftar</button>
        </form>

        <p class="login-link">Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a></p>
    </div>
</body>

</html>