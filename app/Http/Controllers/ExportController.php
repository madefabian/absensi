<?php

namespace App\Http\Controllers;

use App\Models\Rapat;
use Maatwebsite\Excel\Facades\Excel;
use App\Filament\Exports\AbsensiExport;
use Illuminate\Support\Facades\Gate;

class ExportController extends Controller
{
    /**
     * Export absensi rapat ke Excel dengan gambar tanda tangan
     */
    public function exportAbsensi(Rapat $rapat)
    {
        // Cek autorisasi jika diperlukan
        // Gate::authorize('export', $rapat);

        $fileName = 'Absensi_' . $rapat->judul . '_' . now()->format('d-m-Y_H-i-s') . '.xlsx';

        return Excel::download(
            new AbsensiExport($rapat),
            $fileName
        );
    }
}
