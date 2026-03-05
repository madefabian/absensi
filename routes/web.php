<?php

use App\Http\Controllers\AbsensiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RapatController;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

/*
|--------------------------------------------------------------------------
| Halaman Utama
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Absensi via QR Code (Publik)
|--------------------------------------------------------------------------
*/

Route::get('/absensi/{token}', [AbsensiController::class, 'scan'])->name('absensi.scan');
Route::post('/absensi/{token}', [AbsensiController::class, 'store'])->name('absensi.store');
Route::get('/absensi/{token}/sudah-absen', [AbsensiController::class, 'sudahAbsen'])->name('absensi.sudah-absen');

/*
|--------------------------------------------------------------------------
| Export
|--------------------------------------------------------------------------
*/

Route::get('/rapat/{rapat}/export', [AbsensiController::class, 'export'])->name('rapat.export');

/*
|--------------------------------------------------------------------------
| File Barcode PDF
|--------------------------------------------------------------------------
*/
Route::get('/barcode-pdf/{id}', [RapatController::class, 'downloadUndangan'])
    ->name('rapat.undangan');







    
    Route::get('/test-qr', function () {

    $options = new QROptions([
        'outputType' => QRCode::OUTPUT_STRING_PNG,
        'scale' => 5,
    ]);

    $qr = (new QRCode($options))->render('TEST QR');

    return response($qr)->header('Content-Type', 'image/png');
});
