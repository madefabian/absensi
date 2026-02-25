<?php

use App\Exports\AbsensiExport;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\AuthController;
use App\Models\Rapat;
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
| Auth
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'login'])
    ->name('login')
    ->middleware('guest');

Route::post('/login', [AuthController::class, 'authenticate'])
    ->middleware('guest');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

/*
|--------------------------------------------------------------------------
<<<<<<< HEAD
| Absensi via QR Code (Publik)
=======
| Rapat (Perlu Login)
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
>>>>>>> 8b82e2657f1bd4940355322e75ae7d602cd12185
|--------------------------------------------------------------------------
*/

<<<<<<< HEAD
Route::get('/absensi/{token}', [AbsensiController::class, 'scan'])
    ->name('absensi.scan');

Route::post('/absensi/{token}', [AbsensiController::class, 'store'])
    ->name('absensi.store');

Route::get('/rapat/qr/{token}', [RapatQrController::class, 'show'])
    ->name('rapat.qr');

Route::post('/store', [StoreController::class, 'store'])->name('store');
=======
Route::get('/absensi/{token}', [AbsensiController::class, 'scan'])->name('absensi.scan');
Route::post('/absensi/{token}', [AbsensiController::class, 'store'])->name('absensi.store');
>>>>>>> 6e84a4abc956863b8c820cda601803c568dd41a9
