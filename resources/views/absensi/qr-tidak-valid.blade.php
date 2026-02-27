<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Tidak Valid</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --green-pale: #EEF3EC;
            --cream:      #F8F5F0;
            --ink:        #1C1C1C;
            --muted:      #6B7280;
            --border:     #D9DDD6;
            --white:      #FFFFFF;
            --red:        #d31616;
        }

        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            background-color: var(--cream);
            background-image:
                radial-gradient(circle at 20% 20%, rgba(74,103,65,0.06) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(74,103,65,0.04) 0%, transparent 50%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'DM Sans', sans-serif;
            padding: 32px 16px;
        }

        .card {
            background: var(--white);
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.08), 0 0 0 1px var(--border);
            width: 100%;
            max-width: 420px;
            overflow: hidden;
            text-align: center;
        }

        .card-header {
            background: var(--red);
            padding: 36px 40px 32px;
            position: relative;
        }

        .card-header::after {
            content: '';
            position: absolute;
            bottom: -1px; left: 0; right: 0;
            height: 24px;
            background: var(--white);
            border-radius: 12px 12px 0 0;
        }

        .header-label {
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: rgba(255,255,255,0.65);
            margin-bottom: 6px;
        }

        .header-title {
            font-family: 'Playfair Display', serif;
            font-size: 24px;
            color: var(--white);
        }

        .card-body {
            padding: 12px 40px 40px;
        }

        .icon {
            width: 56px;
            height: 56px;
            background: #FEE2E2;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            animation: shake 0.5s ease;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25%       { transform: translateX(-5px); }
            75%       { transform: translateX(5px); }
        }

        .message {
            font-size: 15px;
            color: var(--ink);
            font-weight: 500;
            margin-bottom: 8px;
        }

        .sub-message {
            font-size: 13px;
            color: var(--muted);
            font-weight: 300;
            line-height: 1.6;
        }

        .card-footer {
            padding: 14px 40px;
            background: var(--green-pale);
            border-top: 1px solid var(--border);
            font-size: 11.5px;
            color: var(--muted);
        }
    </style>
</head>
<body>

<div class="card">

    <div class="card-header">
        <p class="header-label">Kesalahan</p>
        <h1 class="header-title">QR Tidak Valid</h1>
    </div>

    <div class="card-body">

        <div class="icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M18 6L6 18M6 6l12 12" stroke="#B91C1C" stroke-width="2" stroke-linecap="round"/>
            </svg>
        </div>

        <p class="message">QR Code tidak ditemukan atau nonaktif</p>
        <p class="sub-message">Silakan hubungi admin atau scan ulang QR Code yang benar.</p>

    </div>

    <div class="card-footer">
        Data absensi bersifat resmi dan akan disimpan dalam sistem
    </div>

</div>

</body>
</html>