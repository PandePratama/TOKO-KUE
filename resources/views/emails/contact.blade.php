<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Kontak dari JajanSnack</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: linear-gradient(135deg, #7f574c, #b45309);
            color: #ffffff;
            padding: 20px;
            border-radius: 8px 8px 0 0;
            text-align: center;
        }
        .header h2 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 20px;
        }
        .info-box {
            background-color: #faf7f5;
            padding: 15px;
            border-left: 4px solid #7f574c;
            margin-bottom: 15px;
            border-radius: 4px;
        }
        .info-box p {
            margin: 5px 0;
        }
        .info-box strong {
            color: #7f574c;
        }
        .message-box {
            background-color: #f9f9f9;
            padding: 15px;
            border: 1px solid #eee;
            border-radius: 4px;
            margin-top: 15px;
            white-space: pre-wrap;
            word-wrap: break-word;
        }
        .footer {
            background-color: #f9f9f9;
            padding: 15px;
            border-top: 1px solid #eee;
            text-align: center;
            font-size: 12px;
            color: #666;
            margin-top: 20px;
            border-radius: 0 0 8px 8px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>📨 Pesan Kontak Baru</h2>
        </div>

        <div class="content">
            <p>Halo,</p>
            <p>Anda menerima pesan baru melalui formulir kontak website JajanSnack:</p>

            <div class="info-box">
                <p><strong>Nama Pengirim:</strong> {{ $name }}</p>
                <p><strong>Email:</strong> <a href="mailto:{{ $email }}">{{ $email }}</a></p>
                <p><strong>Subjek:</strong> {{ $subject_message }}</p>
            </div>

            <p><strong>Pesan:</strong></p>
            <div class="message-box">{{ $body }}</div>

            <p style="margin-top: 20px; color: #666; font-size: 14px;">
                <em>Anda dapat membalas pesan ini langsung ke email pengirim. Reply-To telah diatur secara otomatis.</em>
            </p>
        </div>

        <div class="footer">
            <p>© {{ now()->year }} JajanSnack. Semua hak cipta dilindungi.</p>
            <p>Email ini dikirim secara otomatis dari sistem kontak website.</p>
        </div>
    </div>
</body>
</html>
