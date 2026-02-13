<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Absensi</title>
    @vite('resources/css/app.css')
    <style>
        canvas {
            border: 2px solid #e5e7eb;
            width: 100%;
            height: 200px;
            touch-action: none;
            background: #f9fafb;
            border-radius: 0.5rem;
            cursor: crosshair;
        }

        canvas:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #1f2937;
            font-size: 0.95rem;
        }

        input[type="text"] {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid #e5e7eb;
            border-radius: 0.5rem;
            font-size: 1rem;
            transition: all 0.3s;
        }

        input[type="text"]:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .button-group {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        button {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 0.5rem;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-clear {
            background-color: #ef4444;
            color: white;
            flex: 1;
        }

        .btn-clear:hover {
            background-color: #dc2626;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
        }

        .btn-submit {
            background-color: #10b981;
            color: white;
            flex: 1;
        }

        .btn-submit:hover {
            background-color: #059669;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        .btn-submit:disabled {
            background-color: #d1d5db;
            cursor: not-allowed;
            transform: none;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen flex items-center justify-center p-4">

<div class="w-full max-w-md bg-white rounded-2xl shadow-2xl p-8">
    <!-- Header -->
    <div class="mb-8 text-center">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Form Absensi</h1>
        <p class="text-lg text-indigo-600 font-semibold">{{ $rapat->judul }}</p>
        <p class="text-sm text-gray-500 mt-1">📅 {{ \Carbon\Carbon::parse($rapat->tanggal)->translatedFormat('l, d F Y') }}</p>
        <p class="text-sm text-gray-500">📍 {{ $rapat->lokasi }}</p>
    </div>

    <form method="POST">
        @csrf

        <!-- Nama Field -->
        <div class="form-group">
            <label for="nama">👤 Nama Lengkap</label>
            <input type="text" id="nama" name="nama" placeholder="Masukkan nama lengkap Anda" required>
        </div>

        <!-- Jabatan Field -->
        <div class="form-group">
            <label for="jabatan">💼 Jabatan</label>
            <input type="text" id="jabatan" name="jabatan" placeholder="Masukkan jabatan Anda" required>
        </div>

        <!-- Signature Field -->
        <div class="form-group">
            <label for="signature">✍️ Tanda Tangan</label>
            <p class="text-xs text-gray-500 mb-2">Tanda tangan di area berikut dengan jari atau mouse</p>
            <canvas id="signature"></canvas>
            <input type="hidden" name="tanda_tangan" id="tanda_tangan">
        </div>

        <!-- Button Group -->
        <div class="button-group">
            <button type="button" class="btn-clear" onclick="clearCanvas()">🗑️ Hapus TTD</button>
            <button type="submit" class="btn-submit" onclick="saveSignature()">✅ Simpan Absensi</button>
        </div>
    </form>

    <!-- Info Text -->
    <p class="text-xs text-gray-400 text-center mt-6">Pastikan semua data terisi sebelum menyimpan</p>
</div>

<script>
const canvas = document.getElementById('signature');
const ctx = canvas.getContext('2d');

canvas.width = canvas.offsetWidth;
canvas.height = canvas.offsetHeight;

let drawing = false;

function startDraw(e) {
    drawing = true;
    ctx.beginPath();
    ctx.moveTo(getX(e), getY(e));
}

function draw(e) {
    if (!drawing) return;
    ctx.lineTo(getX(e), getY(e));
    ctx.stroke();
}

function stopDraw() {
    drawing = false;
}

function getX(e) {
    return e.touches ? e.touches[0].clientX - canvas.offsetLeft : e.offsetX;
}

function getY(e) {
    return e.touches ? e.touches[0].clientY - canvas.offsetTop : e.offsetY;
}

canvas.addEventListener('mousedown', startDraw);
canvas.addEventListener('mousemove', draw);
canvas.addEventListener('mouseup', stopDraw);

canvas.addEventListener('touchstart', startDraw);
canvas.addEventListener('touchmove', draw);
canvas.addEventListener('touchend', stopDraw);

function clearCanvas() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
}

function saveSignature() {
    document.getElementById('tanda_tangan').value = canvas.toDataURL();
}
</script>

</body>
</html>
