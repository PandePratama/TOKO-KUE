<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - JajanSnack</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <style>
        .back-link {
            margin-top: 20px;
            color: #555;
            font-size: 15px;
        }

        .back-link a {
            color: #7f574c;
            font-weight: 600;
            text-decoration: none;
        }

        .back-link a:hover {
            text-decoration: underline;
        }

        .success-messages {
            background: #d1fae5;
            color: #065f46;
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 1px solid #a7f3d0;
            text-align: left;
            font-size: 14px;
        }

        .hint-text {
            color: #777;
            font-size: 14px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h2>Lupa Password</h2>

        <p class="hint-text">Masukkan email Anda dan kami akan mengirimkan link untuk mereset password.</p>

        <form method="POST" action="/forgot-password">
            @csrf
            <input type="email" name="email" placeholder="Alamat Email" value="{{ old('email') }}" required>
            <button type="submit">Kirim Link Reset</button>
        </form>

        {{-- Status sukses --}}
        @if (session('status'))
        <div class="success-messages">{{ session('status') }}</div>
        @endif

                {{-- Pesan error --}}
        @if ($errors->any())
        <div class="error-messages">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <p class="back-link"><a href="{{ route('login') }}">← Kembali ke Login</a></p>
    </div>
</body>

</html>