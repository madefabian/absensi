<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;

class AbsensiController extends Controller
{
   public function scan($token)
{
    $rapat = \App\Models\Absensi::where('uuid', $token)->first();

    if (!$rapat) {
        return "QR tidak valid";
    }

    return view('absensi.form', compact('rapat'));
}

public function store(Request $request, $token)
{
    $rapat = \App\Models\Absensi::where('uuid', $token)->first();

    if (!$rapat) {
        return "QR tidak valid";
    }

    $request->validate([
        'nama' => 'required',
    ]);

    $rapat->update([
        'nama_pengisi' => $request->nama,
        'status' => 'hadir',
    ]);

    return "Absensi berhasil";
}

}
