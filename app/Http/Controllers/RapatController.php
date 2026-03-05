<?php

namespace App\Http\Controllers;

use App\Models\Rapat;
use Barryvdh\DomPDF\Facade\Pdf;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;

class RapatController extends Controller
{

   public function downloadUndangan($id)
{
    $rapat = Rapat::findOrFail($id);

    $result = Builder::create()
        ->writer(new PngWriter())
        ->data(route('absensi.scan', $rapat->qr_token))
        ->size(200)
        ->build();

    $qrBase64 = base64_encode($result->getString());

    $pdf = Pdf::loadView('barcode-pdf', [
        'rapat' => $rapat,
        'qrBase64' => $qrBase64
    ]);

    return $pdf->stream('barcode-pdf');
}

}
