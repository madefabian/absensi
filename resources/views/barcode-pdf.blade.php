<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Undangan Rapat</title>
    <style>
        body {
            font-family: sans-serif;
            text-align: center;
            margin-top: 100px;
        }
        h2 {
            margin-bottom: 30px;
        }
        p {
            margin: 10px 0;
        }
        .qr {
            margin-top: 40px;
        }
    </style>
</head>
<body>

    <h2>{{ $rapat->judul }}</h2>

    <p>
        Kami memohon kesediaan Bapak/Ibu/Saudara/i
        untuk dapat hadir dalam rapat yang akan dilaksanakan pada:
    </p>

    <p>
        <strong>Tanggal:</strong> {{ $rapat->tanggal }} <br>
        <strong>Jam:</strong> {{ $rapat->jam_mulai }} - {{ $rapat->jam_selesai }} <br>
        <strong>Lokasi:</strong> {{ $rapat->lokasi }}
    </p>

    <div style="margin-top:40px;">
    <p><strong>Scan QR untuk Absensi:</strong></p>
    <img src="data:image/png;base64,{{ $qrBase64 }}" width="300">
</div>

    <p style="margin-top:40px;">
        Atas perhatian dan kehadirannya kami ucapkan terima kasih.
    </p>

</body>
</html>
