<head>
    <meta charset="UTF-8">
    <title>QR Tidak Valid</title>
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

        .error-icon {
            font-size: 60px;
            margin-bottom: 20px;
            animation: shake 0.6s ease;
        }

        h1 {
            font-size: 26px;
            color: #e74c3c;
            margin-bottom: 16px;
        }

        .message {
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
        }

        .button:hover {
            background-color: #7a8c6b;
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(156, 175, 136, 0.3);
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-4px); }
            75% { transform: translateX(4px); }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="error-icon">❌</div>
        <h1>QR Tidak Valid</h1>
        <p class="message">
            QR Code tidak ditemukan atau sudah dinonaktifkan.
            Silakan hubungi admin atau scan ulang QR yang benar.
        </p>
    </div>
</body>
