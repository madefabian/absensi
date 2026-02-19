<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Rapat - Absensi QR</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.5.3/build/qrcode.min.js"></script>
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
            <div class="mb-8">
                <a href="{{ route('welcome') }}" class="text-[#9CAF88] hover:text-[#8a9975] text-sm mb-4 inline-block font-medium">
                    ← Kembali ke Daftar Rapat
                </a>
                <h1 class="text-4xl font-bold text-gray-900">{{ $rapat->judul }}</h1>
            </div>

            <div class="grid md:grid-cols-2 gap-8">
                <!-- Detail Rapat -->
                <div class="bg-white rounded-lg shadow-lg p-8 border-t-4 border-[#9CAF88]">
                    <h2 class="text-2xl font-bold text-[#9CAF88] mb-6">Detail Rapat</h2>

                    <div class="space-y-4">
                        <div>
                            <p class="text-sm text-gray-600">Judul Rapat</p>
                            <p class="text-lg font-medium text-gray-900">{{ $rapat->judul }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-600">Tanggal</p>
                            <p class="text-lg font-medium text-gray-900">{{ \Carbon\Carbon::parse($rapat->tanggal)->format('l, d F Y') }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-600">Waktu</p>
                            <p class="text-lg font-medium text-gray-900">{{ $rapat->jam_mulai }} - {{ $rapat->jam_selesai }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-600">Lokasi</p>
                            <p class="text-lg font-medium text-gray-900">{{ $rapat->lokasi }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-600">Status QR</p>
                            <p class="text-lg font-medium">
                                @if ($rapat->qr_status)
                                    <span class="inline-block bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">Aktif</span>
                                @else
                                    <span class="inline-block bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm">Non-Aktif</span>
                                @endif
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-600">Token QR</p>
                            <p class="text-sm font-mono text-gray-900 break-all">{{ $rapat->qr_token }}</p>
                        </div>

                        <div class="mt-6 pt-6 border-t">
                            <p class="text-sm text-gray-600">URL Absensi</p>
                            <p class="text-sm font-mono bg-gray-100 p-2 rounded break-all">{{ $rapat->qr_url }}</p>
                            <button onclick="copyToClipboard('{{ $rapat->qr_url }}')" class="mt-2 text-blue-600 hover:text-blue-700 text-sm font-medium">
                                Salin URL
                            </button>
                        </div>
                    </div>
                </div>

                <!-- QR Code -->
                <div class="bg-white rounded-lg shadow-lg p-8 flex flex-col items-center justify-center border-t-4 border-[#9CAF88]">
                    <h2 class="text-2xl font-bold text-[#9CAF88] mb-6 w-full">QR Code Absensi</h2>

                    <div id="qrcode" class="mb-6"></div>

                    <button onclick="downloadQR()" class="w-full bg-[#9CAF88] text-white font-medium py-3 px-4 rounded-md hover:bg-[#8a9975] transition mb-2 font-semibold">
                        ⬇️ Download QR Code
                    </button>

                    <button onclick="printQR()" class="w-full bg-[#8C8C8C] text-white font-medium py-3 px-4 rounded-md hover:bg-[#757575] transition font-semibold">
                        🖨️ Print QR Code
                    </button>

                    <div class="mt-6 p-4 bg-[#F3ECDC] rounded-md border-2 border-[#9CAF88] w-full">
                        <p class="text-sm text-gray-700 text-center font-medium">
                            Peserta dapat memindai QR code ini untuk mengisi absensi
                        </p>
                    </div>
                </div>
            </div>

            <!-- Daftar Peserta Absensi -->
            <div class="mt-8 bg-white rounded-lg shadow-lg p-8 border-t-4 border-[#9CAF88]">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-[#9CAF88]">Daftar Peserta Absensi</h2>
                    @if (!$rapat->absensis->isEmpty())
                        <a href="{{ route('rapat.export', $rapat) }}" class="bg-[#9CAF88] text-white font-medium py-2 px-4 rounded-md hover:bg-[#8a9975] transition inline-flex items-center gap-2">
                            📥 Export ke Excel
                        </a>
                    @endif
                </div>

                @if ($rapat->absensis->isEmpty())
                    <p class="text-gray-600 text-center py-8">Belum ada peserta yang absen</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-[#F3ECDC] border-b-2 border-[#9CAF88]">
                                <tr>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-[#8C8C8C]">No.</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-[#8C8C8C]">Nama</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-[#8C8C8C]">Jabatan</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-[#8C8C8C]">Waktu Scan</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-[#8C8C8C]">Status</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-[#8C8C8C]">Tanda Tangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rapat->absensis as $key => $absensi)
                                    <tr class="border-b hover:bg-[#F3ECDC] transition">
                                        <td class="px-6 py-4 text-sm text-gray-600">{{ $key + 1 }}</td>
                                        <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $absensi->nama }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-600">{{ $absensi->jabatan }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-600">{{ $absensi->waktu_scan ? \Carbon\Carbon::parse($absensi->waktu_scan)->format('d/m/Y H:i') : '-' }}</td>
                                        <td class="px-6 py-4 text-sm">
                                            @if ($absensi->status === 'hadir')
                                                <span class="inline-block bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-medium">Hadir</span>
                                            @else
                                                <span class="inline-block bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-xs font-medium">Telat</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-sm">
                                            @if ($absensi->tanda_tangan && file_exists(public_path($absensi->tanda_tangan)))
                                                <button
                                                    onclick="openSignatureModal('{{ asset($absensi->tanda_tangan) }}', '{{ $absensi->nama }}')"
                                                    class="text-[#9CAF88] hover:text-[#8a9975] font-medium inline-flex items-center gap-1">
                                                    👁️ Lihat
                                                </button>
                                            @else
                                                <span class="text-gray-400 text-xs">Tidak ada</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <p class="text-sm text-gray-600 mt-4">Total Peserta: <strong>{{ $rapat->absensis->count() }}</strong></p>
                @endif
            </div>

            <!-- Modal Preview Tanda Tangan -->
            <div id="signatureModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
                <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-8 border-t-4 border-[#9CAF88]">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold text-[#9CAF88]">Tanda Tangan</h3>
                        <button onclick="closeSignatureModal()" class="text-gray-400 hover:text-gray-600 text-2xl">×</button>
                    </div>

                    <div class="mb-6">
                        <p id="signatureName" class="text-sm text-gray-600 mb-3">Nama: -</p>
                        <div class="border-2 border-[#9CAF88] rounded-lg p-4 bg-[#F3ECDC] flex justify-center">
                            <img id="signatureImage" src="" alt="Tanda Tangan" class="max-w-xs max-h-48 object-contain">
                        </div>
                    </div>

                    <div class="flex gap-2">
                        <button
                            onclick="downloadSignature()"
                            class="flex-1 bg-[#9CAF88] text-white font-medium py-2 px-4 rounded-md hover:bg-[#8a9975] transition">
                            Download
                        </button>
                        <button
                            onclick="closeSignatureModal()"
                            class="flex-1 bg-[#8C8C8C] text-white font-medium py-2 px-4 rounded-md hover:bg-[#757575] transition">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Generate QR Code
        const qrUrl = "{{ $rapat->qr_url }}";
        const qrCanvas = document.getElementById('qrcode');

        QRCode.toCanvas(qrCanvas, qrUrl, {
            width: 300,
            margin: 2,
            color: {
                dark: '#000000',
                light: '#FFFFFF'
            }
        }, function (error) {
            if (error) console.error(error);
        });

        // Download QR Code
        function downloadQR() {
            const canvas = document.querySelector('#qrcode canvas');
            if (!canvas) {
                alert('QR Code belum siap. Silakan tunggu sebentar.');
                return;
            }

            canvas.toBlob(function(blob) {
                const url = window.URL.createObjectURL(blob);
                const link = document.createElement('a');
                link.href = url;
                link.download = 'qr-{{ $rapat->judul }}-{{ now()->format('d-m-Y') }}.png';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
                window.URL.revokeObjectURL(url);
            });
        }

        // Print QR Code
        function printQR() {
            const canvas = document.querySelector('#qrcode canvas');
            if (!canvas) {
                alert('QR Code belum siap. Silakan tunggu sebentar.');
                return;
            }

            const printWindow = window.open('', '', 'width=600,height=700');
            const dataUrl = canvas.toDataURL('image/png');

            printWindow.document.write(`
                <html>
                <head>
                    <title>Print QR Code</title>
                    <style>
                        body { text-align: center; padding: 20px; font-family: Arial, sans-serif; }
                        h2 { margin-bottom: 20px; }
                        img { max-width: 300px; margin: 20px 0; }
                        .info { margin-top: 20px; text-align: left; display: inline-block; border: 1px solid #ddd; padding: 15px; border-radius: 5px; }
                        @media print { body { margin: 0; } }
                    </style>
                </head>
                <body>
                    <h2>QR Code Absensi</h2>
                    <h3>{{ $rapat->judul }}</h3>
                    <img src="${dataUrl}" />
                    <div class="info">
                        <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($rapat->tanggal)->format('d/m/Y') }}</p>
                        <p><strong>Waktu:</strong> {{ $rapat->jam_mulai }} - {{ $rapat->jam_selesai }}</p>
                        <p><strong>Lokasi:</strong> {{ $rapat->lokasi }}</p>
                    </div>
                </body>
                </html>
            `);
            printWindow.document.close();
            setTimeout(() => {
                printWindow.print();
            }, 250);
        }

        // Copy to Clipboard
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                alert('URL berhasil disalin ke clipboard');
            });
        }

        // Signature Modal Functions
        function openSignatureModal(imageUrl, name) {
            document.getElementById('signatureImage').src = imageUrl;
            document.getElementById('signatureName').textContent = 'Nama: ' + name;
            document.getElementById('signatureModal').classList.remove('hidden');
        }

        function closeSignatureModal() {
            document.getElementById('signatureModal').classList.add('hidden');
        }

        function downloadSignature() {
            const image = document.getElementById('signatureImage');
            const name = document.getElementById('signatureName').textContent.replace('Nama: ', '');
            const link = document.createElement('a');
            link.href = image.src;
            link.download = 'tanda_tangan_' + name.replace(/\s+/g, '_') + '.png';
            link.click();
        }

        // Close modal when clicking outside
        document.getElementById('signatureModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeSignatureModal();
            }
        });
    </script>
</body>
</html>
