@php
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

$record = $record ?? ($getRecord() ?? null);

if (!$record || !$record->qr_token) {
    echo '<span class="text-gray-400">QR belum ada</span>';
    return;
}

$options = new QROptions([
    'outputType' => QRCode::OUTPUT_IMAGE_PNG,
    'eccLevel' => QRCode::ECC_L,
    'scale' => 4,
]);

$url = url('/absensi/' . $record->qr_token);
$image = (new QRCode($options))->render($url);
@endphp

<img
    src="{{ $image }}"
    alt="QR Code"
    style="width:80px;height:80px"
/>
