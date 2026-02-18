<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Rapat Baru - Absensi QR</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Instrument Sans', sans-serif;
        }
    </style>
</head>
<body class="bg-[#F3ECDC]">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-md bg-white rounded-lg shadow-lg p-8 border-t-4 border-[#9CAF88]">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-[#9CAF88]">Buat Rapat</h1>
                <p class="mt-2 text-gray-600">Masukkan detail rapat untuk membuat QR code absensi</p>
            </div>

            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded">
                    <ul class="list-disc list-inside text-red-700">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('rapat.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Judul Rapat -->
                <div>
                    <label for="judul" class="block text-sm font-medium text-gray-900">Judul Rapat</label>
                    <input
                        type="text"
                        name="judul"
                        id="judul"
                        value="{{ old('judul') }}"
                        required
                        placeholder="Contoh: Meeting Bulanan"
                        class="mt-1 block w-full px-4 py-2 border-2 border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#9CAF88] focus:border-[#9CAF88]"
                    >
                </div>

                <!-- Tanggal -->
                <div>
                    <label for="tanggal" class="block text-sm font-medium text-gray-900">Tanggal Rapat</label>
                    <input
                        type="date"
                        name="tanggal"
                        id="tanggal"
                        value="{{ old('tanggal') }}"
                        required
                        class="mt-1 block w-full px-4 py-2 border-2 border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#9CAF88] focus:border-[#9CAF88]"
                    >
                </div>

                <!-- Jam Mulai -->
                <div>
                    <label for="jam_mulai" class="block text-sm font-medium text-gray-900">Jam Mulai</label>
                    <input
                        type="time"
                        name="jam_mulai"
                        id="jam_mulai"
                        value="{{ old('jam_mulai') }}"
                        required
                        class="mt-1 block w-full px-4 py-2 border-2 border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#9CAF88] focus:border-[#9CAF88]"
                    >
                </div>

                <!-- Jam Selesai -->
                <div>
                    <label for="jam_selesai" class="block text-sm font-medium text-gray-900">Jam Selesai</label>
                    <input
                        type="time"
                        name="jam_selesai"
                        id="jam_selesai"
                        value="{{ old('jam_selesai') }}"
                        required
                        class="mt-1 block w-full px-4 py-2 border-2 border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#9CAF88] focus:border-[#9CAF88]"
                    >
                </div>

                <!-- Lokasi -->
                <div>
                    <label for="lokasi" class="block text-sm font-medium text-gray-900">Lokasi Rapat</label>
                    <input
                        type="text"
                        name="lokasi"
                        id="lokasi"
                        value="{{ old('lokasi') }}"
                        required
                        placeholder="Contoh: Ruang Meeting A"
                        class="mt-1 block w-full px-4 py-2 border-2 border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#9CAF88] focus:border-[#9CAF88]"
                    >
                </div>

                <!-- Tombol Submit -->
                <button
                    type="submit"
                    class="w-full bg-[#9CAF88] text-white font-semibold py-3 px-4 rounded-md hover:bg-[#8a9975] focus:outline-none focus:ring-2 focus:ring-[#9CAF88] focus:ring-offset-2 transition"
                >
                    ✓ Buat Rapat & Generate QR
                </button>

                <!-- Link Kembali -->
                <div class="text-center">
                    <a href="{{ route('rapat.index') }}" class="text-[#9CAF88] hover:text-[#8a9975] text-sm font-medium">
                        ← Kembali ke Daftar Rapat
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
