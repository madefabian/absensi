<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Absensi Rapat RSUD Kota Bogor</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg: #f5f4f0;
            --surface: #ffffff;
            --border: #e2e0da;
            --text: #1a1917;
            --muted: #6b6a65;
            --accent: #2563eb;
            --accent-hover: #1d4ed8;
        }

        @media (prefers-color-scheme: dark) {
            :root {
                --bg: #111110;
                --surface: #1c1c1a;
                --border: #2e2e2b;
                --text: #ededec;
                --muted: #888784;
                --accent: #3b82f6;
                --accent-hover: #60a5fa;
            }
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }

        .wrapper {
            width: 100%;
            max-width: 420px;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
            animation: fadeUp 0.4s ease both;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Header Nav */
        nav {
            display: flex;
            justify-content: flex-end;
            gap: 0.5rem;
        }

        nav a {
            font-size: 0.8125rem;
            font-weight: 500;
            color: var(--muted);
            text-decoration: none;
            padding: 0.375rem 0.875rem;
            border-radius: 6px;
            border: 1px solid var(--border);
            transition: color 0.15s, border-color 0.15s, background 0.15s;
        }

        nav a:hover {
            color: var(--text);
            border-color: var(--muted);
        }

        nav a.primary {
            background: var(--accent);
            border-color: var(--accent);
            color: #fff;
        }

        nav a.primary:hover {
            background: var(--accent-hover);
            border-color: var(--accent-hover);
        }

        /* Card */
        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 2rem;
        }

        /* QR Icon */
        .icon-wrap {
            width: 48px;
            height: 48px;
            background: var(--bg);
            border: 1px solid var(--border);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.25rem;
        }

        .icon-wrap svg {
            width: 24px;
            height: 24px;
            color: var(--accent);
        }

        h1 {
            font-size: 1.125rem;
            font-weight: 600;
            letter-spacing: -0.02em;
            margin-bottom: 0.375rem;
        }

        .subtitle {
            font-size: 0.875rem;
            color: var(--muted);
            line-height: 1.5;
            margin-bottom: 1.75rem;
        }

        /* Action Buttons */
        .actions {
            display: flex;
            flex-direction: column;
            gap: 0.625rem;
            margin-bottom: 1.75rem;
        }

        .btn {
            display: block;
            text-align: center;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            padding: 0.625rem 1rem;
            border-radius: 8px;
            border: 1px solid transparent;
            transition: background 0.15s, border-color 0.15s, opacity 0.15s;
        }

        .btn-primary {
            background: var(--accent);
            color: #fff;
        }

        .btn-primary:hover { background: var(--accent-hover); }

        .btn-secondary {
            background: transparent;
            color: var(--text);
            border-color: var(--border);
        }

        .btn-secondary:hover { border-color: var(--muted); }

        /* Steps */
        .steps-label {
            font-size: 0.75rem;
            font-weight: 500;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.06em;
            margin-bottom: 0.75rem;
        }

        .steps {
            display: flex;
            flex-direction: column;
            gap: 0;
        }

        .step {
            display: flex;
            align-items: flex-start;
            gap: 0.875rem;
            padding: 0.625rem 0;
            position: relative;
        }

        .step:not(:last-child)::after {
            content: '';
            position: absolute;
            left: 0.5625rem;
            top: calc(0.625rem + 18px);
            bottom: calc(-0.625rem);
            width: 1px;
            background: var(--border);
        }

        .step-dot {
            width: 18px;
            height: 18px;
            border-radius: 50%;
            border: 1px solid var(--border);
            background: var(--surface);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            margin-top: 1px;
        }

        .step-dot span {
            font-family: 'DM Mono', monospace;
            font-size: 0.625rem;
            color: var(--muted);
        }

        .step-text {
            font-size: 0.8125rem;
            color: var(--muted);
            line-height: 1.5;
        }

        .step-text strong {
            color: var(--text);
            font-weight: 500;
        }

        /* Footer */
        .footer {
            text-align: center;
            font-size: 0.75rem;
            color: var(--muted);
        }
    </style>
</head>
<body>
    <div class="wrapper">

        {{-- Main Card --}}
        <div class="card">
            <div class="icon-wrap">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/>
                    <path d="M14 14h3v3M17 20h3M20 17v3"/>
                </svg>
            </div>

            <h1>Absensi Rapat RSUD Kota Bogor</h1>
            <p class="subtitle">Kelola rapat dan catat kehadiran peserta secara otomatis menggunakan QR code.</p>

            <div class="actions">
                <a href="/admin" class="btn btn-primary">Masuk ke Panel Admin</a>
            </div>


        </div>

        <p class="footer">PKLNUBAS &mdash; 2026</p>

    </div>
</body>
</html>