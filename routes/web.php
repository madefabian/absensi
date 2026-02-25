<?php

use App\Http\Controllers\AbsensiController;
use Illuminate\Support\Facades\Route;

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
