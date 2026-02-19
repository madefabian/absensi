<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Rapat - Absensi QR</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Instrument Sans', sans-serif;
        }
    </style>
</head>
<body class="bg-[#F3ECDC]">
    <div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="mb-8 flex justify-between items-center">
                <div>
                    <h1 class="text-4xl font-bold text-gray-900">Daftar Rapat</h1>
                    <p class="mt-2 text-gray-600">Kelola semua rapat dan QR code absensi</p>
                </div>
                <a href="{{ route('rapat.create') }}" class="bg-[#9CAF88] text-white font-medium py-3 px-6 rounded-md hover:bg-[#8a9975] transition font-semibold">
                    + Buat Rapat Baru
                </a>
            </div>

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            @if ($rapats->isEmpty())
                <div class="bg-white rounded-lg shadow-lg p-8 text-center border-t-4 border-[#9CAF88]">
                    <p class="text-gray-600 mb-4">Belum ada rapat. Buat rapat baru untuk memulai.</p>
                    <a href="{{ route('rapat.create') }}" class="inline-block bg-[#9CAF88] text-white font-medium py-2 px-6 rounded-md hover:bg-[#8a9975] transition font-semibold">
                        Buat Rapat Baru
                    </a>
                </div>
            @else
                <div class="bg-white rounded-lg shadow-lg overflow-hidden border-t-4 border-[#9CAF88]">
                    <table class="w-full">
                        <thead class="bg-[#F3ECDC] border-b-2 border-[#9CAF88]">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-[#8C8C8C]">Judul</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-[#8C8C8C]">Tanggal</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-[#8C8C8C]">Waktu</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-[#8C8C8C]">Lokasi</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-[#8C8C8C]">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rapats as $rapat)
                                <tr class="border-b hover:bg-[#F3ECDC] transition">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $rapat->judul }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ \Carbon\Carbon::parse($rapat->tanggal)->format('d/m/Y') }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $rapat->jam_mulai }} - {{ $rapat->jam_selesai }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $rapat->lokasi }}</td>
                                    <td class="px-6 py-4 text-sm">
                                        <a href="{{ route('rapat.show', $rapat) }}" class="text-[#9CAF88] hover:text-[#8a9975] font-medium">
                                            Lihat Detail & QR
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            <!-- Footer -->
            <div class="mt-8 text-center">
                <a href="{{ route('absensi.scan', ['token' => 'test']) }}" class="text-[#9CAF88] hover:text-[#8a9975] text-sm font-medium">
                    ← Kembali ke Halaman Utama
                </a>
            </div>
        </div>
    </div>
</body>
</html>
