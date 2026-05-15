<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - JajanSnack</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <style>
        .success-messages {
            background: #d1fae5;
            color: #065f46;
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 1px solid #a7f3d0;
            font-size: 14px;
        }
    </style>

</head>

<body>
    <div class="login-container">
        <h2>Login</h2>

        {{-- Pesan Sukses --}}
        @if (session('success'))
        <div class="success-messages">{{ session('success') }}</div>
        @endif

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

        <!-- <p class="register-link"><a href="{{ route('password.request') }}">Lupa Password?</a></p> -->
        <p class="register-link">Belum punya akun? <a href="{{ route('register') }}">Daftar Sekarang</a></p>
    </div>
</body>

</html>