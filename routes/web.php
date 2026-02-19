<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\RapatQrController;

Route::get('/absensi/{token}', [AbsensiController::class, 'scan'])
    ->name('absensi.scan');

Route::post('/absensi/{token}', [AbsensiController::class, 'store']);

Route::get('/rapat/qr/{token}', [RapatQrController::class, 'show'])
    ->name('rapat.qr');

Route::get('/', function () {
    return view('welcome');
});

