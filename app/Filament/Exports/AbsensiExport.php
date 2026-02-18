<?php

namespace App\Filament\Exports;

use App\Models\Rapat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class AbsensiExport implements FromCollection, WithHeadings, WithColumnFormatting, WithDrawings
{
    protected Rapat $rapat;
    protected array $signaturePaths = [];

    public function __construct(Rapat $rapat)
    {
        $this->rapat = $rapat;
    }

    public function collection(): Collection
    {
        // Ambil semua absensi untuk rapat ini
        $absensis = $this->rapat->absensis()
            ->select('nama', 'jabatan', 'waktu_scan', 'status', 'tanda_tangan', 'uuid')
            ->get();

        // Transform data
        return $absensis->map(function ($absensi, $index) {
            return [
                'No' => $index + 1,
                'Nama' => $absensi->nama,
                'Jabatan' => $absensi->jabatan,
                'Waktu Scan' => $absensi->waktu_scan ? \Carbon\Carbon::parse($absensi->waktu_scan)->format('d/m/Y H:i:s') : '-',
                'Status' => ucfirst($absensi->status),
                'Tanda Tangan' => $absensi->tanda_tangan ?? '-',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama',
            'Jabatan',
            'Waktu Scan',
            'Status',
            'Tanda Tangan',
        ];
    }

    public function columnFormats(): array
    {
        return [
            'A' => '0', // No
            'B' => '@', // Nama
            'C' => '@', // Jabatan
            'D' => 'dd/mm/yyyy hh:mm:ss', // Waktu Scan
            'E' => '@', // Status
            'F' => '@', // Tanda Tangan (path/info)
        ];
    }

    public function drawings(): array
    {
        $drawings = [];
        $rowNumber = 2; // Mulai dari baris 2 (setelah header)

        $absensis = $this->rapat->absensis()
            ->select('tanda_tangan', 'uuid', 'nama')
            ->get();

        foreach ($absensis as $absensi) {
            $signaturePath = $this->convertBase64ToFile($absensi->tanda_tangan, $absensi->uuid);

            // Cek apakah file tanda tangan exists atau berhasil dibuat
            if ($signaturePath && file_exists(public_path($signaturePath))) {
                $drawing = new Drawing();
                $drawing->setName('Tanda Tangan ' . $absensi->nama);
                $drawing->setDescription('Tanda Tangan');
                $drawing->setPath(public_path($signaturePath));
                $drawing->setHeight(50); // Tinggi 50px
                $drawing->setWidth(80); // Lebar 80px

                // Letakkan di kolom F (Tanda Tangan)
                $drawing->setCoordinates('F' . $rowNumber);

                $drawings[] = $drawing;
            }

            $rowNumber++;
        }

        return $drawings;
    }

    /**
     * Convert base64 signature to PNG file
     */
    private function convertBase64ToFile($base64Data, $uuid): ?string
    {
        if (!$base64Data) {
            return null;
        }

        try {
            // Cek apakah data sudah berupa file path (bukan base64)
            if (!str_contains($base64Data, ',')) {
                // Jika sudah berupa path, return langsung
                if (file_exists(public_path($base64Data))) {
                    return $base64Data;
                }
                return null;
            }

            // Extract base64 data jika ada prefix seperti "data:image/png;base64,"
            $base64String = explode(',', $base64Data)[1] ?? $base64Data;

            // Decode base64
            $imageData = base64_decode($base64String);

            if ($imageData === false) {
                return null;
            }

            // Buat directory jika belum ada
            $directory = 'public/signatures';
            if (!file_exists(public_path('signatures'))) {
                mkdir(public_path('signatures'), 0755, true);
            }

            // Generate nama file dengan UUID
            $fileName = 'signatures/' . $uuid . '.png';
            $filePath = public_path($fileName);

            // Simpan file PNG
            file_put_contents($filePath, $imageData);

            return $fileName;
        } catch (\Exception $e) {
            return null;
        }
    }
}
