<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - JajanSnack</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">

</head>

<body>
    <div class="login-container">
        <h2>Login</h2>

        {{-- Pesan Error --}}
        @if (session('error'))
        <div class="error-messages">{{ session('error') }}</div>
        @endif

        @if ($errors->any())
        <div class="error-messages">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        {{-- Form Login --}}
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <input type="email" id="email" name="email" placeholder="Alamat Email" value="{{ old('email') }}" required>
            <input type="password" id="password" name="password" placeholder="Kata Sandi" required>
            <button type="submit">Masuk</button>
        </form>

        <p class="register-link">Belum punya akun? <a href="{{ route('register') }}">Daftar Sekarang</a></p>
    </div>
</body>

</html>