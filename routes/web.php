<?php

use App\Http\Controllers\AbsensiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\RapatQrController;
use App\Http\Controllers\RapatController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\AuthController;
use App\Exports\AbsensiExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Rapat;

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

Route::middleware('auth')->group(function () {

    Route::get('/rapats', [RapatController::class, 'index'])->name('rapat.index');
    Route::get('/rapats/create', [RapatController::class, 'create'])->name('rapat.create');
    Route::post('/rapats', [RapatController::class, 'store'])->name('rapat.store');
    Route::get('/rapats/{rapat}', [RapatController::class, 'show'])->name('rapat.show');

    Route::get('/rapats/{rapat}/export', function (Rapat $rapat) {
        $fileName = 'absensi_' . str($rapat->judul)->slug() . '_' . now()->format('d-m-Y') . '.xlsx';
        return Excel::download(new AbsensiExport($rapat), $fileName);
    })->name('rapat.export');
});

/*
|--------------------------------------------------------------------------
| Absensi via QR (Publik)
|--------------------------------------------------------------------------
*/

Route::get('/absensi/{token}', [AbsensiController::class, 'scan'])
    ->name('absensi.scan');

Route::post('/absensi/{token}', [AbsensiController::class, 'store'])
    ->name('absensi.store');

Route::get('/rapat/qr/{token}', [RapatQrController::class, 'show'])
    ->name('rapat.qr');

Route::post('/store', [StoreController::class, 'store'])->name('store');
Route::get('/absensi/{token}', [AbsensiController::class, 'scan'])->name('absensi.scan');
Route::post('/absensi/{token}', [AbsensiController::class, 'store'])->name('absensi.store');
