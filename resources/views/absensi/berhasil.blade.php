<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Absensi Berhasil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @vite('resources/css/app.css')
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-100">

    <div class="bg-white p-6 rounded shadow max-w-md w-full text-center space-y-4">
        <h1 class="text-2xl font-bold text-green-600">
            ✅ Absensi Berhasil
        </h1>

        <p class="text-gray-700">
            Terima kasih, absensi rapat berhasil dicatat.
        </p>

        <div class="text-sm text-gray-500">
            <p><strong>Rapat:</strong> {{ $rapat->judul }}</p>
            <p><strong>Tanggal:</strong> {{ $rapat->tanggal }}</p>
            <p><strong>Lokasi:</strong> {{ $rapat->lokasi }}</p>
        </div>

        <p class="text-xs text-gray-400">
            Waktu scan: {{ now() }}
        </p>
    </div>

</body>
</html>
