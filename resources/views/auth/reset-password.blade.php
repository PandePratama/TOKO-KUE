<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - JajanSnack</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <style>
        input[type="text"] {
            width: 100%;
            padding: 13px 15px;
            margin-bottom: 18px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 15px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            font-family: 'Poppins', sans-serif;
            box-sizing: border-box;
        }

        input[type="text"]:focus {
            outline: none;
            border-color: #7f574c;
            box-shadow: 0 0 6px rgba(127, 87, 76, 0.4);
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h2>Reset Password</h2>

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

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <input type="email" name="email" placeholder="Alamat Email" value="{{ old('email') }}" required>
            <input type="password" name="password" placeholder="Password Baru" required>
            <input type="password" name="password_confirmation" placeholder="Konfirmasi Password Baru" required>

            <button type="submit">Reset Password</button>
        </form>
    </div>
</body>

</html>
