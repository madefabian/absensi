<?php

namespace App\Http\Controllers;

use App\Models\Rapat;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{
    // ===================================
    // SCAN QR → TAMPIL FORM DULU
    // ===================================
    public function scan(string $token)
    {
        // CEK LOGIN
        if (!Auth::check()) {
            return response()->view('absensi.belum-login', [], 401);
        }

        $user = Auth::user();

        // CEK RAPAT + QR AKTIF
        $rapat = Rapat::where('qr_token', $token)
            ->where('qr_status', true)
            ->first();

        if (!$rapat) {
            return response()->view('absensi.qr-tidak-valid', [], 404);
        }

        // CEK SUDAH ABSEN
        $sudahAbsen = Absensi::where('rapat_id', $rapat->id)
            ->where('user_id', $user->id)
            ->exists();

        if ($sudahAbsen) {
            return response()->view('absensi.sudah-absen', [
                'rapat' => $rapat,
            ], 403);
        }

        // ✅ TAMPILKAN FORM ABSENSI
        return view('absensi.form', compact('rapat'));
    }


    // ===================================
    // SUBMIT FORM → SIMPAN ABSENSI
    // ===================================
    public function store(Request $request, string $token)
    {
        if (!Auth::check()) {
            return response()->view('absensi.belum-login', [], 401);
        }

        $user = Auth::user();

        $rapat = Rapat::where('qr_token', $token)
            ->where('qr_status', true)
            ->firstOrFail();

        // CEK DOUBLE ABSEN
        $sudahAbsen = Absensi::where('rapat_id', $rapat->id)
            ->where('user_id', $user->id)
            ->exists();

        if ($sudahAbsen) {
            return response()->view('absensi.sudah-absen', [
                'rapat' => $rapat,
            ], 403);
        }

        // VALIDASI FORM
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'tanda_tangan' => 'required',
        ]);

        // SIMPAN ABSENSI
        Absensi::create([
            'rapat_id' => $rapat->id,
            'user_id' => $user->id,
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'tanda_tangan' => $request->tanda_tangan,
            'waktu_scan' => now(),
            'status' => 'hadir',
        ]);

        return view('absensi.berhasil', compact('rapat'));
    }
}
