<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi; // pastikan modelnya ada

class StoreController extends Controller
{
    public function store(Request $request)
    {
        // Buat folder jika belum ada
        $folderPath = public_path('uploads/');
        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0777, true);
        }

        // Ambil data base64
        $image_parts = explode(";base64,", $request->tanda_tangan);

        if (count($image_parts) > 1) {

            $image_base64 = base64_decode($image_parts[1]);

            $fileName = uniqid() . '.png';
            $file = $folderPath . $fileName;

            file_put_contents($file, $image_base64);

            // Simpan ke database
            Absensi::create([
                'nama' => $request->nama,
                'tanda_tangan' => 'uploads/' . $fileName,
            ]);

            return back()->with('success', 'Data berhasil disimpan');
        }

        return back()->with('error', 'Tanda tangan tidak valid');
    }
}
