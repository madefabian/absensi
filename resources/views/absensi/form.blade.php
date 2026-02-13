<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Absensi</title>
    <style>
        canvas {
            border: 2px dashed #999;
            width: 100%;
            height: 200px;
            touch-action: none;
        }
    </style>
</head>
<body>

<h2>Absensi Rapat: {{ $rapat->judul }}</h2>

<form method="POST">
    @csrf

    <label>Nama</label><br>
    <input type="text" name="nama" required><br><br>

    <label>Jabatan</label><br>
    <input type="text" name="jabatan" required><br><br>

    <label>Tanda Tangan</label><br>
    <canvas id="signature"></canvas>
    <input type="hidden" name="tanda_tangan" id="tanda_tangan">

    <br>
    <button type="button" onclick="clearCanvas()">Hapus TTD</button>
    <br><br>

    <button type="submit" onclick="saveSignature()">Simpan Absensi</button>
</form>

<script>
lucide.createIcons();

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

// Animasi sukses sebelum submit
document.getElementById('absenForm').addEventListener('submit', function(e) {
    saveSignature();

    document.getElementById('submitBtn').innerHTML =
        '<svg class="animate-spin h-4 w-4 mr-2 inline-block" viewBox="0 0 24 24"></svg> Memproses...';

    setTimeout(() => {
        document.getElementById('successBox').classList.remove('hidden');
    }, 500);
});
</script>

<style>
@keyframes fadeIn {
    from { opacity: 0; transform: scale(0.95); }
    to { opacity: 1; transform: scale(1); }
}
.animate-fade-in {
    animation: fadeIn 0.4s ease-out forwards;
}
</style>

</body>
</html>
