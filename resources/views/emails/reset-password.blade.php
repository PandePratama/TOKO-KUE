<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 40px 20px;
            text-align: center;
            color: white;
        }

        .header h1 {
            font-size: 28px;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .header p {
            font-size: 14px;
            opacity: 0.9;
        }

        .content {
            padding: 40px 30px;
        }

        .greeting {
            font-size: 18px;
            color: #333;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .message {
            font-size: 14px;
            color: #666;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .message p {
            margin-bottom: 15px;
        }

        .button-container {
            text-align: center;
            margin: 35px 0;
        }

        .reset-button {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 14px 40px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 600;
            font-size: 16px;
            transition: transform 0.2s, box-shadow 0.2s;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        .reset-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.6);
        }

        .alternative-link {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-top: 20px;
            font-size: 12px;
        }

        .alternative-link p {
            color: #666;
            margin-bottom: 8px;
        }

        .alternative-link a {
            color: #667eea;
            word-break: break-all;
            text-decoration: none;
        }

        .security-notice {
            background-color: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            margin-top: 25px;
            border-radius: 3px;
            font-size: 13px;
            color: #856404;
        }

        .security-notice strong {
            color: #333;
        }

        .footer {
            background-color: #f8f9fa;
            padding: 30px 30px;
            border-top: 1px solid #e9ecef;
            text-align: center;
            font-size: 12px;
            color: #666;
        }

        .footer p {
            margin-bottom: 10px;
        }

        .footer a {
            color: #667eea;
            text-decoration: none;
        }

        .divider {
            height: 1px;
            background-color: #e9ecef;
            margin: 20px 0;
        }

        @media only screen and (max-width: 600px) {
            .container {
                border-radius: 0;
            }

            .header {
                padding: 30px 15px;
            }

            .header h1 {
                font-size: 24px;
            }

            .content {
                padding: 25px 15px;
            }

            .reset-button {
                padding: 12px 30px;
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>🔐 Reset Password</h1>
            <p>Toko Kue - Permintaan Reset Password</p>
        </div>

        <!-- Content -->
        <div class="content">
            <div class="greeting">
                Halo {{ $user->name }},
            </div>

            <div class="message">
                <p>Kami menerima permintaan untuk mereset password akun Anda. Jika Anda tidak membuat permintaan ini, abaikan email ini.</p>

                <p>Untuk mereset password Anda, klik tombol di bawah ini:</p>
            </div>

            <!-- Reset Button -->
            <div class="button-container">
                <a href="{{ $resetUrl }}" class="reset-button">Reset Password Sekarang</a>
            </div>

            <!-- Alternative Link -->
            <div class="alternative-link">
                <p><strong>Atau copy link ini di browser Anda:</strong></p>
                <a href="{{ $resetUrl }}">{{ $resetUrl }}</a>
            </div>

            <!-- Security Notice -->
            <div class="security-notice">
                <strong>⚠️ Penting:</strong> Link reset password ini akan berlaku selama 60 menit. Setelah itu, Anda harus membuat permintaan reset password baru.
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div class="divider"></div>
            <p>© {{ date('Y') }} Toko Kue. Semua hak cipta dilindungi.</p>
            <p>Jika Anda memiliki pertanyaan, hubungi kami di support@tokokue.com</p>
            <p>
                <a href="#">Kebijakan Privasi</a> |
                <a href="#">Syarat & Ketentuan</a>
            </p>
        </div>
    </div>
</body>

</html>