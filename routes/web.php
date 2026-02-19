<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AbsensiController;
<<<<<<< HEAD
use App\Http\Controllers\RapatQrController;

Route::get('/absensi/{token}', [AbsensiController::class, 'scan'])
    ->name('absensi.scan');

Route::post('/absensi/{token}', [AbsensiController::class, 'store']);

Route::get('/rapat/qr/{token}', [RapatQrController::class, 'show'])
    ->name('rapat.qr');
=======
use App\Http\Controllers\ExportController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\RapatController;

/*
|--------------------------------------------------------------------------
| RAPAT ROUTES
|--------------------------------------------------------------------------
*/

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
>>>>>>> 70be02f57cb47ceae4e81711a054e31c8e686253

Route::get('/', function () {
    return view('welcome');
});

<<<<<<< HEAD
=======
Route::post('/store', [StoreController::class, 'store'])->name('store');




>>>>>>> 70be02f57cb47ceae4e81711a054e31c8e686253
