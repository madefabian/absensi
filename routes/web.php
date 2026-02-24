<?php

use App\Exports\AbsensiExport;
use App\Http\Controllers\AbsensiController;
<<<<<<< HEAD
use App\Http\Controllers\RapatQrController;

Route::get('/absensi/{token}', [AbsensiController::class, 'scan'])
    ->name('absensi.scan');

Route::post('/absensi/{token}', [AbsensiController::class, 'store']);

Route::get('/rapat/qr/{token}', [RapatQrController::class, 'show'])
    ->name('rapat.qr');
use App\Http\Controllers\ExportController;
=======
>>>>>>> 6d1290b1eea6e1b266b260b4dc8d2e02359031f1
use App\Http\Controllers\AuthController;
use App\Models\Rapat;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

/*
|--------------------------------------------------------------------------
| Halaman Utama
|--------------------------------------------------------------------------
*/

<<<<<<< HEAD
Route::get('/rapats', [RapatController::class, 'index'])->name('rapat.index');
Route::get('/rapats/create', [RapatController::class, 'create'])->name('rapat.create');
Route::post('/rapats', [RapatController::class, 'store'])->name('rapat.store');
Route::get('/rapats/{rapat}', [RapatController::class, 'show'])->name('rapat.show');

/*
|--------------------------------------------------------------------------
| EXPORT ABSENSI (MASIH DIGUNAKAN DARI FILAMENT DETAIL PAGE)
|--------------------------------------------------------------------------
*/

Route::get('/rapats/{rapat}/export', [ExportController::class, 'exportAbsensi'])->name('rapat.export');


/*
|--------------------------------------------------------------------------
| ABSENSI QR CODE (PUBLIC - TANPA PERLU LOGIN)
|--------------------------------------------------------------------------
*/

Route::get('/absensi/{token}', [AbsensiController::class, 'scan'])->name('absensi.scan');
Route::post('/absensi/{token}', [AbsensiController::class, 'store'])->name('absensi.store');


/*
|--------------------------------------------------------------------------
| LOGOUT
|--------------------------------------------------------------------------
*/

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');


/*
|--------------------------------------------------------------------------
| ROUTE YANG PERLU LOGIN
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    //
});

=======
>>>>>>> 6d1290b1eea6e1b266b260b4dc8d2e02359031f1
Route::get('/', function () {
    return view('welcome');
});

<<<<<<< HEAD
Route::post('/store', [StoreController::class, 'store'])->name('store');
=======
/*
|--------------------------------------------------------------------------
| Auth
|--------------------------------------------------------------------------
*/
>>>>>>> 6d1290b1eea6e1b266b260b4dc8d2e02359031f1

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

<<<<<<< HEAD
=======
/*
|--------------------------------------------------------------------------
| Absensi via QR Code (Publik)
|--------------------------------------------------------------------------
*/

Route::get('/absensi/{token}', [AbsensiController::class, 'scan'])->name('absensi.scan');
Route::post('/absensi/{token}', [AbsensiController::class, 'store'])->name('absensi.store');
>>>>>>> 6d1290b1eea6e1b266b260b4dc8d2e02359031f1
