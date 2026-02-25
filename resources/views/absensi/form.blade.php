<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Absensi Rapat</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2/dist/tailwind.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #ffffffff 0%, #ffffff 100%);
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
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 20px;
        }

        .header h1 {
            font-size: 28px;
            color: #1a1a1a;
            margin-bottom: 8px;
        }

        .header p {
            color: #7f8c8d;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 24px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #2c3e50;
            font-weight: 600;
            font-size: 14px;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e8e8e8;
            border-radius: 8px;
            font-size: 14px;
            font-family: inherit;
            transition: all 0.3s ease;
            background-color: #fafafa;
        }

        input[type="text"]:focus,
        textarea:focus {
            outline: none;
            border-color: #9CAF88;
            background-color: white;
            box-shadow: 0 0 0 3px rgba(156, 175, 136, 0.1);
        }

        input[type="email"] {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e8e8e8;
            border-radius: 8px;
            font-size: 14px;
            font-family: inherit;
            transition: all 0.3s ease;
            background-color: #fafafa;
        }

        input[type="email"]:focus,
        textarea:focus {
            outline: none;
            border-color: #9CAF88;
            background-color: white;
            box-shadow: 0 0 0 3px rgba(156, 175, 136, 0.1);
        }

        canvas {
            border: 2px dashed #9CAF88;
            width: 100%;
            height: 200px;
            touch-action: none;
            border-radius: 8px;
            background-color: #F3ECDC;
            cursor: crosshair;
            transition: border-color 0.3s ease;
        }

        canvas:focus {
            border-color: #9CAF88;
            background-color: white;
        }

        .canvas-label {
            display: block;
            margin-bottom: 8px;
            color: #2c3e50;
            font-weight: 600;
            font-size: 14px;
        }

        .button-group {
            display: flex;
            gap: 12px;
            margin-top: 32px;
        }

        button {
            flex: 1;
            padding: 12px 20px;
            font-size: 14px;
            font-weight: 600;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-secondary {
            background-color: #ecf0f1;
            color: #2c3e50;
        }

        .btn-secondary:hover {
            background-color: #d5dbdb;
            transform: translateY(-2px);
        }

        .btn-primary {
            background-color: #9CAF88;
            color: white;
        }

        .btn-primary:hover {
            background-color: #7a8c6b;
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(156, 175, 136, 0.3);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .info-box {
            background-color: #F3ECDC;
            border-left: 4px solid #9CAF88;
            padding: 12px 16px;
            border-radius: 6px;
            margin-bottom: 24px;
            font-size: 13px;
            color: #2c3e50;
            line-height: 1.5;
        }

        .success-message {
            background-color: #d4edda;
            border: 2px solid #28a745;
            color: #155724;
            padding: 16px;
            border-radius: 8px;
            text-align: center;
            display: none;
            margin-top: 20px;
        }

        .success-message.show {
            display: block;
            animation: slideIn 0.5s ease;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h1>📋 Absensi Rapat</h1>
        <p>{{ isset($rapat) ? $rapat->judul : 'Form Absensi' }}</p>
    </div>

    <form method="POST" id="absenForm">
        @csrf

        <div class="info-box">
            ✓ Mohon isi data lengkap sebelum mengirim absensi
        </div>

        <div class="form-group">
            <label for="nama">Nama Lengkap</label>
            <input type="text" id="nama" name="nama" placeholder="Masukkan nama lengkap Anda" required>
        </div>

        <div class="form-group">
            <label for="jabatan">Jabatan</label>
            <input type="text" id="jabatan" name="jabatan" placeholder="Masukkan jabatan Anda" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Masukkan email Anda" required>
        </div>

        <div class="form-group">
            <label for="no_hp">Nomor HP</label>
            <input type="text" id="no_hp" name="no_hp" placeholder="Masukkan nomor HP Anda" required>
        </div>

        <div class="form-group">
            <label for="status">Status Kehadiran</label>
            <select id="status" name="status" required style="width: 100%; padding: 12px 16px; border: 2px solid #e8e8e8; border-radius: 8px; font-size: 14px; background-color: #fafafa; transition: all 0.3s ease; cursor: pointer;">
                <option value="" disabled selected>Pilih Status</option>
                <option value="hadir">✓ Hadir</option>
                <option value="sakit">🏥 Sakit</option>
                <option value="izin">📝 Izin</option>
            </select>
            <style>
                select:focus {
                    outline: none;
                    border-color: #9CAF88;
                    background-color: white;
                    box-shadow: 0 0 0 3px rgba(156, 175, 136, 0.1);
                }
                select option {
                    padding: 10px;
                    background-color: white;
                    color: #2c3e50;
                }
            </style>
        </div>

        <div class="form-group">
            <span class="canvas-label">Tanda Tangan</span>
            <canvas id="signature"></canvas>
            <input type="hidden" name="tanda_tangan" id="tanda_tangan">
            <p style="font-size: 12px; color: #95a5a6; margin-top: 8px;">Tanda tangani di atas untuk konfirmasi</p>
        </div>

        <div class="button-group">
            <button type="button" class="btn-secondary" onclick="clearCanvas()">🗑️ Hapus TTD</button>
            <button type="submit" class="btn-primary" id="submitBtn">✓ Simpan Absensi</button>
        </div>
    </form>

    <div class="success-message" id="successBox">
        <p style="font-size: 16px; font-weight: 600;">✓ Absensi Berhasil Disimpan</p>
    </div>
</div>

<script>
    const canvas = document.getElementById('signature');
    const ctx = canvas.getContext('2d');

    canvas.width = canvas.offsetWidth;
    canvas.height = canvas.offsetHeight;

    // Styling canvas
    ctx.strokeStyle = '#2c3e50';
    ctx.lineWidth = 2;
    ctx.lineCap = 'round';
    ctx.lineJoin = 'round';

    let drawing = false;

    function startDraw(e) {
        drawing = true;
        const pos = getPos(e);
        ctx.beginPath();
        ctx.moveTo(pos.x, pos.y);
    }

    function draw(e) {
        if (!drawing) return;
        const pos = getPos(e);
        ctx.lineTo(pos.x, pos.y);
        ctx.stroke();
    }

    function stopDraw() {
        drawing = false;
        ctx.closePath();
    }

    function getPos(e) {
        const rect = canvas.getBoundingClientRect();
        if (e.touches) {
            return {
                x: e.touches[0].clientX - rect.left,
                y: e.touches[0].clientY - rect.top
            };
        }
        return {
            x: e.clientX - rect.left,
            y: e.clientY - rect.top
        };
    }

    canvas.addEventListener('mousedown', startDraw);
    canvas.addEventListener('mousemove', draw);
    canvas.addEventListener('mouseup', stopDraw);
    canvas.addEventListener('mouseout', stopDraw);

    canvas.addEventListener('touchstart', startDraw);
    canvas.addEventListener('touchmove', draw);
    canvas.addEventListener('touchend', stopDraw);

    function clearCanvas() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
    }

    function saveSignature() {
        document.getElementById('tanda_tangan').value = canvas.toDataURL();
    }

    document.getElementById('absenForm').addEventListener('submit', function(e) {
        e.preventDefault();
        saveSignature();

        const submitBtn = document.getElementById('submitBtn');
        submitBtn.disabled = true;
        submitBtn.innerHTML = '⏳ Memproses...';

        setTimeout(() => {
            document.getElementById('successBox').classList.add('show');
            setTimeout(() => {
                this.submit();
            }, 1500);
        }, 500);
    });
</script>

</body>
</html>
