<?php

namespace App\Http\Controllers;

use App\Exports\AbsensiExport;
use App\Models\Absensi;
use App\Models\Rapat;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AbsensiController extends Controller
{
    public function scan($token)
    {
        $rapat = Rapat::where('qr_token', $token)->first();

        if (!$rapat || !$rapat->qr_status) {
            return view('absensi.qr-tidak-valid');
        }

        return view('absensi.form', compact('rapat'));
    }

    public function store(Request $request, $token)
    {
        $rapat = Rapat::where('qr_token', $token)->first();

        if (!$rapat || !$rapat->qr_status) {
            return view('absensi.qr-tidak-valid');
        }

        $request->validate([
            'nip'          => 'required|string|max:50',
            'nama'         => 'required|string|max:255',
            'jabatan'      => 'required|string|max:255',
            'status'       => 'required|in:hadir,sakit,izin',
            'tanda_tangan' => 'nullable|string',
        ]);

        // Cek duplikat berdasarkan NIP + Nama di rapat yang sama
        $sudahAbsen = Absensi::where('rapat_id', $rapat->id)
            ->where('nip', $request->nip)
            ->where('nama', $request->nama)
            ->exists();

        if ($sudahAbsen) {
            return redirect()->route('absensi.sudah-absen', $token);
        }

        Absensi::create([
            'user_id'      => auth()->id(),
            'rapat_id'     => $rapat->id,
            'waktu_scan'   => now(),
            'nip'          => $request->nip,
            'nama'         => $request->nama,
            'jabatan'      => $request->jabatan,
            'status'       => $request->status,
            'tanda_tangan' => $request->tanda_tangan,
        ]);

        return view('absensi.berhasil');
    }

    public function sudahAbsen($token)
    {
        $rapat = Rapat::where('qr_token', $token)->first();

        return view('absensi.sudah-absen', compact('rapat'));
    }

    public function export(Rapat $rapat)
    {
        return Excel::download(new AbsensiExport($rapat), 'absensi-' . $rapat->id . '.xlsx');
    }
}