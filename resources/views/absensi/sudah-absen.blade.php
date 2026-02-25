<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sudah Absen</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --green:      #4A6741;
            --green-pale: #EEF3EC;
            --cream:      #F8F5F0;
            --ink:        #1C1C1C;
            --muted:      #6B7280;
            --border:     #D9DDD6;
            --white:      #FFFFFF;
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
            background: #B45309;
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
            background: #FEF3C7;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
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
            margin-bottom: 24px;
        }

        .rapat-name {
            background: var(--green-pale);
            border: 1px solid #C4D4BE;
            border-radius: 6px;
            padding: 12px 16px;
            font-size: 13px;
            color: var(--green);
            font-weight: 500;
            margin-bottom: 28px;
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
        <p class="header-label">Pemberitahuan</p>
        <h1 class="header-title">Absensi Sudah Tercatat</h1>
    </div>

    <div class="card-body">

        <div class="icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M12 9v4M12 17h.01" stroke="#B45309" stroke-width="2" stroke-linecap="round"/>
                <path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" stroke="#B45309" stroke-width="2" stroke-linejoin="round"/>
            </svg>
        </div>

        <p class="message">Anda sudah melakukan absensi</p>
        <p class="sub-message">
            Data absensi Anda dengan NIP dan nama yang sama sudah tercatat sebelumnya.
            Setiap peserta hanya dapat absen satu kali.
        </p>

        @if(isset($rapat))
        <div class="rapat-name">
            📋 {{ $rapat->judul }}
        </div>
        @endif

    </div>

    <div class="card-footer">
        Data absensi bersifat resmi dan akan disimpan dalam sistem
    </div>

</div>

</body>
</html>