<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Absensi</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Lucide -->
    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body class="bg-gradient-to-br from-indigo-600 via-blue-600 to-purple-600 min-h-screen flex items-center justify-center p-4">

<div class="relative w-full max-w-md">

    <!-- SUCCESS OVERLAY -->
    <div id="successBox" class="hidden absolute inset-0 bg-white rounded-3xl shadow-2xl flex flex-col items-center justify-center text-center p-8 animate-fade-in">
        <div class="bg-green-100 p-4 rounded-full mb-4">
            <i data-lucide="check-circle" class="w-10 h-10 text-green-600"></i>
        </div>
        <h3 class="text-xl font-bold text-gray-800">Absensi Berhasil!</h3>
        <p class="text-gray-500 mt-2 text-sm">Terima kasih sudah melakukan absensi.</p>
    </div>

    <!-- CARD -->
    <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-2xl p-8">

        <h2 class="text-2xl font-bold text-center text-gray-800 mb-2">
            Absensi Rapat
        </h2>

        <p class="text-center text-gray-500 text-sm mb-6">
            {{ $rapat->judul }}
        </p>

        <form method="POST" id="absenForm" class="space-y-5">
            @csrf

            <!-- Nama -->
            <div>
                <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-1">
                    <i data-lucide="user" class="w-4 h-4"></i>
                    Nama
                </label>
                <input type="text" name="nama" required
                    class="w-full px-4 py-2 border rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none transition">
            </div>

            <!-- Jabatan -->
            <div>
                <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-1">
                    <i data-lucide="briefcase" class="w-4 h-4"></i>
                    Jabatan
                </label>
                <input type="text" name="jabatan" required
                    class="w-full px-4 py-2 border rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none transition">
            </div>

            <!-- Tanda Tangan -->
            <div>
                <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-2">
                    <i data-lucide="pen-tool" class="w-4 h-4"></i>
                    Tanda Tangan
                </label>

                <div class="border-2 border-dashed border-gray-300 rounded-xl">
                    <canvas id="signature" class="w-full h-48 touch-none"></canvas>
                </div>

                <input type="hidden" name="tanda_tangan" id="tanda_tangan">
            </div>

            <!-- Hapus -->
            <button type="button" onclick="clearCanvas()"
                class="flex items-center justify-center gap-2 w-full bg-gray-200 hover:bg-gray-300 text-gray-700 py-2 rounded-xl font-semibold transition">
                <i data-lucide="trash-2" class="w-4 h-4"></i>
                Hapus TTD
            </button>

            <!-- Submit -->
            <button type="submit" id="submitBtn"
                class="flex items-center justify-center gap-2 w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2 rounded-xl font-semibold transition duration-200">
                <i data-lucide="send" class="w-4 h-4"></i>
                Simpan Absensi
            </button>

        </form>

        <p class="text-xs text-gray-400 text-center mt-4">
            Pastikan tanda tangan sudah diisi sebelum menyimpan.
        </p>

    </div>
</div>

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
