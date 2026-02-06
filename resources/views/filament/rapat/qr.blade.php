@php
    use chillerlan\QRCode\QRCode;
    use chillerlan\QRCode\QROptions;

    $options = new QROptions([
        'outputType' => QRCode::OUTPUT_MARKUP_SVG,
        'eccLevel' => QRCode::ECC_L,
    ]);

    $qrcode = (new QRCode($options))->render($record->qr_url);
@endphp

<div class="space-y-3">
    <div class="text-sm text-gray-600">
        Scan QR ini untuk absensi rapat
    </div>

    <div class="p-4 bg-white border rounded w-fit">
        {!! $qrcode !!}
    </div>

    <div class="text-xs break-all text-gray-500">
        {{ $record->qr_url }}
    </div>
</div>
