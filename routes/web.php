<?php

use App\Exports\AbsensiExport;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\AuthController;
use App\Models\Rapat;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

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
| Auth
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Export Absensi (butuh login)
|--------------------------------------------------------------------------
*/

Route::get('/rapats/{rapat}/export', function (Rapat $rapat) {
    $fileName = 'absensi_' . str($rapat->judul)->slug() . '_' . now()->format('d-m-Y') . '.xlsx';
    return Excel::download(new AbsensiExport($rapat), $fileName);
})->name('rapat.export')->middleware('auth');

/*
|--------------------------------------------------------------------------
| Absensi via QR Code (Publik)
|--------------------------------------------------------------------------
*/

Route::get('/absensi/{token}', [AbsensiController::class, 'scan'])->name('absensi.scan');
Route::post('/absensi/{token}', [AbsensiController::class, 'store'])->name('absensi.store');