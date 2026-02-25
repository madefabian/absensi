<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Absensi Rapat</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --green:       #4A6741;
            --green-light: #6B8F5E;
            --green-pale:  #EEF3EC;
            --cream:       #F8F5F0;
            --ink:         #1C1C1C;
            --muted:       #6B7280;
            --border:      #D9DDD6;
            --white:       #FFFFFF;
            --error:       #C0392B;
            --radius:      6px;
            --shadow:      0 2px 12px rgba(0,0,0,0.08);
        }

        *, *::before, *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

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
            box-shadow: var(--shadow), 0 0 0 1px var(--border);
            width: 100%;
            max-width: 520px;
            overflow: hidden;
        }

        /* ── Header ── */
        .card-header {
            background: var(--green);
            padding: 36px 40px 32px;
            position: relative;
        }

        .card-header::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            right: 0;
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
            font-size: 26px;
            color: var(--white);
            line-height: 1.2;
            margin-bottom: 4px;
        }

        .header-sub {
            font-size: 13px;
            color: rgba(255,255,255,0.7);
            font-weight: 300;
        }

        /* ── Body ── */
        .card-body {
            padding: 8px 40px 40px;
        }

        .notice {
            display: flex;
            align-items: center;
            gap: 10px;
            background: var(--green-pale);
            border: 1px solid #C4D4BE;
            border-radius: var(--radius);
            padding: 11px 14px;
            font-size: 12.5px;
            color: var(--green);
            font-weight: 500;
            margin-bottom: 28px;
        }

        .notice svg { flex-shrink: 0; }

        /* ── Section label ── */
        .section-label {
            font-size: 10.5px;
            font-weight: 600;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 16px;
            padding-bottom: 8px;
            border-bottom: 1px solid var(--border);
        }

        /* ── Form ── */
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-size: 12.5px;
            font-weight: 600;
            color: var(--ink);
            margin-bottom: 6px;
        }

        label .req { color: var(--error); margin-left: 2px; }

        input[type="text"],
        select {
            width: 100%;
            padding: 10px 13px;
            border: 1.5px solid var(--border);
            border-radius: var(--radius);
            font-size: 13.5px;
            font-family: 'DM Sans', sans-serif;
            color: var(--ink);
            background: #FDFCFB;
            transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
            -webkit-appearance: none;
            appearance: none;
        }

        input[type="text"]::placeholder { color: #B5BAB5; font-weight: 300; }

        input[type="text"]:focus,
        select:focus {
            outline: none;
            border-color: var(--green-light);
            background: var(--white);
            box-shadow: 0 0 0 3px rgba(74,103,65,0.1);
        }

        .select-wrap { position: relative; }
        .select-wrap::after {
            content: '';
            position: absolute;
            right: 13px;
            top: 50%;
            transform: translateY(-50%);
            border-left: 4px solid transparent;
            border-right: 4px solid transparent;
            border-top: 5px solid var(--muted);
            pointer-events: none;
        }

        select { cursor: pointer; padding-right: 36px; }

        /* ── Signature ── */
        .sig-section { margin-bottom: 28px; }

        canvas {
            display: block;
            width: 100%;
            height: 180px;
            border: 1.5px dashed #B0C4AA;
            border-radius: var(--radius);
            background: #FAFBF9;
            cursor: crosshair;
            touch-action: none;
            transition: border-color 0.2s;
        }

        canvas:hover { border-color: var(--green-light); }

        .sig-hint {
            font-size: 11.5px;
            color: var(--muted);
            margin-top: 6px;
            font-weight: 300;
        }

        /* ── Actions ── */
        .actions { display: flex; gap: 12px; }

        .btn {
            flex: 1;
            padding: 11px 18px;
            font-size: 13.5px;
            font-weight: 600;
            font-family: 'DM Sans', sans-serif;
            border: none;
            border-radius: var(--radius);
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-outline {
            background: transparent;
            border: 1.5px solid var(--border);
            color: var(--muted);
        }

        .btn-outline:hover {
            border-color: #B0B7B0;
            color: var(--ink);
            background: #F5F5F5;
        }

        .btn-primary {
            background: var(--green);
            color: var(--white);
            box-shadow: 0 2px 8px rgba(74,103,65,0.25);
        }

        .btn-primary:hover {
            background: var(--green-light);
            box-shadow: 0 4px 14px rgba(74,103,65,0.3);
            transform: translateY(-1px);
        }

        .btn-primary:active { transform: translateY(0); }
        .btn-primary:disabled { opacity: 0.65; cursor: not-allowed; transform: none; }

        /* ── Success ── */
        .success-banner {
            display: none;
            align-items: center;
            gap: 10px;
            background: #EAF4EA;
            border: 1px solid #A8D5A8;
            border-radius: var(--radius);
            padding: 14px 16px;
            font-size: 13.5px;
            font-weight: 500;
            color: #2D6A2D;
            margin-top: 20px;
            animation: fadeSlide 0.4s ease;
        }

        .success-banner.show { display: flex; }

        @keyframes fadeSlide {
            from { opacity: 0; transform: translateY(-6px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ── Footer ── */
        .card-footer {
            padding: 14px 40px;
            background: var(--green-pale);
            border-top: 1px solid var(--border);
            font-size: 11.5px;
            color: var(--muted);
            text-align: center;
        }
    </style>
</head>
<body>

<div class="card">

    <div class="card-header">
        <p class="header-label">Formulir Kehadiran</p>
        <h1 class="header-title">Absensi Rapat</h1>
        <p class="header-sub">{{ isset($rapat) ? $rapat->judul : 'Silakan lengkapi data di bawah ini' }}</p>
    </div>

    <div class="card-body">

        <div class="notice">
            <svg width="14" height="14" viewBox="0 0 16 16" fill="none">
                <circle cx="8" cy="8" r="7" stroke="#4A6741" stroke-width="1.5"/>
                <path d="M8 7v4M8 5v.5" stroke="#4A6741" stroke-width="1.5" stroke-linecap="round"/>
            </svg>
            Pastikan semua data yang diisi sudah benar sebelum mengirim
        </div>

        <form method="POST" id="absenForm">
            @csrf

            <p class="section-label">Data Pegawai</p>

            <div class="form-group">
                <label for="nip">Nomor Induk Pegawai (NIP) <span class="req">*</span></label>
                <input type="text" id="nip" name="nip" placeholder="Contoh: 198803012015041001" required>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="nama">Nama Lengkap <span class="req">*</span></label>
                    <input type="text" id="nama" name="nama" placeholder="Nama sesuai ID" required>
                </div>
                <div class="form-group">
                    <label for="jabatan">Jabatan <span class="req">*</span></label>
                    <input type="text" id="jabatan" name="jabatan" placeholder="Jabatan / unit" required>
                </div>
            </div>

            <p class="section-label" style="margin-top: 4px;">Kehadiran</p>

            <div class="form-group">
                <label for="status">Status Kehadiran <span class="req">*</span></label>
                <div class="select-wrap">
                    <select id="status" name="status" required>
                        <option value="" disabled selected>Pilih status kehadiran</option>
                        <option value="hadir">Hadir</option>
                        <option value="sakit">Sakit</option>
                        <option value="izin">Izin</option>
                    </select>
                </div>
            </div>

            <div class="sig-section">
                <label>Tanda Tangan <span class="req">*</span></label>
                <canvas id="signature"></canvas>
                <input type="hidden" name="tanda_tangan" id="tanda_tangan">
                <p class="sig-hint">Tanda tangani di area di atas menggunakan kursor atau sentuhan</p>
            </div>

            <div class="actions">
                <button type="button" class="btn btn-outline" onclick="clearCanvas()">Hapus TTD</button>
                <button type="submit" class="btn btn-primary" id="submitBtn">Simpan Absensi</button>
            </div>

        </form>

        <div class="success-banner" id="successBox">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                <circle cx="8" cy="8" r="7" stroke="#2D6A2D" stroke-width="1.5"/>
                <path d="M5 8l2 2 4-4" stroke="#2D6A2D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Absensi berhasil disimpan. Terima kasih.
        </div>

    </div>

    <div class="card-footer">
        Data absensi bersifat resmi dan akan disimpan dalam sistem
    </div>

</div>

<script>
    const canvas = document.getElementById('signature');
    const ctx    = canvas.getContext('2d');

    function initCanvas() {
        canvas.width  = canvas.offsetWidth;
        canvas.height = canvas.offsetHeight;
        ctx.strokeStyle = '#1C1C1C';
        ctx.lineWidth   = 1.8;
        ctx.lineCap     = 'round';
        ctx.lineJoin    = 'round';
    }

    initCanvas();
    window.addEventListener('resize', initCanvas);

    let drawing = false;

    function getPos(e) {
        const rect = canvas.getBoundingClientRect();
        const src  = e.touches ? e.touches[0] : e;
        return {
            x: (src.clientX - rect.left) * (canvas.width  / rect.width),
            y: (src.clientY - rect.top)  * (canvas.height / rect.height),
        };
    }

    canvas.addEventListener('mousedown',  e => { drawing = true; const p = getPos(e); ctx.beginPath(); ctx.moveTo(p.x, p.y); });
    canvas.addEventListener('mousemove',  e => { if (!drawing) return; const p = getPos(e); ctx.lineTo(p.x, p.y); ctx.stroke(); });
    canvas.addEventListener('mouseup',    () => { drawing = false; ctx.closePath(); });
    canvas.addEventListener('mouseleave', () => { drawing = false; ctx.closePath(); });

    canvas.addEventListener('touchstart', e => { e.preventDefault(); drawing = true; const p = getPos(e); ctx.beginPath(); ctx.moveTo(p.x, p.y); }, { passive: false });
    canvas.addEventListener('touchmove',  e => { e.preventDefault(); if (!drawing) return; const p = getPos(e); ctx.lineTo(p.x, p.y); ctx.stroke(); }, { passive: false });
    canvas.addEventListener('touchend',   () => { drawing = false; ctx.closePath(); });

    function clearCanvas() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
    }

    document.getElementById('absenForm').addEventListener('submit', function(e) {
        e.preventDefault();
        document.getElementById('tanda_tangan').value = canvas.toDataURL();

        const btn = document.getElementById('submitBtn');
        btn.disabled    = true;
        btn.textContent = 'Memproses…';

        setTimeout(() => {
            document.getElementById('successBox').classList.add('show');
            setTimeout(() => this.submit(), 1500);
        }, 500);
    });
</script>

</body>
</html>