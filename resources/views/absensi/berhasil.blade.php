<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Absensi Berhasil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #F3ECDC 0%, #E8DDCC 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 20px;
        }

        .container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 100%;
            max-width: 500px;
            text-align: center;
        }

        .success-icon {
            font-size: 60px;
            margin-bottom: 20px;
            animation: bounce 0.6s ease;
        }

        h1 {
            font-size: 28px;
            color: #9CAF88;
            margin-bottom: 16px;
        }

        .success-message {
            color: #2c3e50;
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 24px;
        }

        .button {
            display: inline-block;
            background-color: #9CAF88;
            color: white;
            padding: 12px 30px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            margin-top: 20px;
        }

        .button:hover {
            background-color: #7a8c6b;
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(156, 175, 136, 0.3);
        }

        @keyframes bounce {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.1);
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="success-icon">✅</div>

    <h1>Absensi Berhasil Disimpan</h1>

    <div class="success-message">
        <p>Terima kasih telah melakukan absensi.</p>
        <p style="margin-top: 16px; color: #7f8c8d; font-size: 14px;">
            Data absensi Anda telah berhasil dicatat dalam sistem.
        </p>
    </div>
</div>

</body>
</html>
