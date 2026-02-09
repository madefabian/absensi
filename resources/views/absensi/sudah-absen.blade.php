<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sudah Absen</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css')
</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-red-50 to-white">

    <div class="bg-white shadow-xl rounded-2xl p-8 max-w-md w-full text-center space-y-6">

        <!-- ICON -->
        <div class="text-6xl">
            ⚠️
        </div>

        <!-- TITLE -->
        <h1 class="text-2xl font-bold text-red-600">
            Kamu Sudah Absen
        </h1>

        <!-- DESC -->
        <p class="text-gray-600">
            Absensi untuk rapat ini sudah tercatat sebelumnya.
        </p>

        <!-- INFO RAPAT -->
        <div class="bg-gray-50 rounded-xl p-4 text-sm text-gray-700 space-y-1">
            <p><span class="font-semibold">Rapat:</span> {{ $rapat->judul }}</p>
            <p><span class="font-semibold">Tanggal:</span> {{ $rapat->tanggal }}</p>
            <p><span class="font-semibold">Lokasi:</span> {{ $rapat->lokasi }}</p>
        </div>

        <!-- FOOTER -->
        <p class="text-xs text-gray-400">
            Jika ada kesalahan, silahkan hubungi admin.
        </p>

    </div>

</body>
</html>
