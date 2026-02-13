<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\RapatQrController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| LOGIN
|--------------------------------------------------------------------------
*/

Route::get('/absensi/{token}', [AbsensiController::class, 'scan'])->middleware('auth');

Route::post('/absensi/{token}', [AbsensiController::class, 'store'])->middleware('auth');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');


/*
|--------------------------------------------------------------------------
| ROUTE YANG PERLU LOGIN
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/absensi/{token}', [AbsensiController::class, 'scan'])
        ->name('absensi.scan');
});

Route::get('/', function () {
    return view('welcome');
});
