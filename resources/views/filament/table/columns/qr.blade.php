@php
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

$token = $getState();

$url = null;
$qrcode = null;

if($token){
    $url = url('/absen/'.$token);

    $options = new QROptions([
        'outputType' => QRCode::OUTPUT_IMAGE_PNG,
    ]);

    $qrcode = (new QRCode($options))->render($url);
}
@endphp

@if($qrcode)
<div class="flex flex-col gap-1 items-start">
    <img src="{{ $qrcode }}" width="110" class="bg-white p-2 rounded border" />
</div>
@else
<span class="text-xs text-gray-400">
    Tidak ada QR
</span>
@endif
