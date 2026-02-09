<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AbsensiController;

Route::middleware('auth')->group(function () {
    Route::get('/absensi/{token}', [AbsensiController::class, 'scan'])
        ->name('absensi.scan');

});



Route::get('/', function () {
    return view('welcome');

});
