<?php

namespace App\Exports;

use App\Models\Rapat;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class InfoRapatSheet implements FromArray, WithTitle, WithStyles, WithColumnWidths
{
    protected Rapat $rapat;

    public function __construct(Rapat $rapat)
    {
        $this->rapat = $rapat;
    }

    public function title(): string
    {
        return 'Informasi Rapat';
    }

    public function array(): array
    {
        $rapat = $this->rapat;
        $totalPeserta = $rapat->absensis->count();
        $totalHadir   = $rapat->absensis->where('status', 'hadir')->count();
        $totalTelat   = $rapat->absensis->where('status', 'telat')->count();

        return [
            ['REKAP ABSENSI RAPAT'],
            [''],
            ['INFORMASI RAPAT'],
            ['Judul Rapat',   $rapat->judul],
            ['Tanggal',       Carbon::parse($rapat->tanggal)->translatedFormat('l, d F Y')],
            ['Waktu',         $rapat->jam_mulai . ' - ' . $rapat->jam_selesai],
            ['Lokasi',        $rapat->lokasi],
            ['Status QR',     $rapat->qr_status ? 'Aktif' : 'Non-Aktif'],
            [''],
            ['STATISTIK KEHADIRAN'],
            ['Total Peserta', $totalPeserta],
            ['Hadir Tepat Waktu', $totalHadir],
            ['Hadir Terlambat',  $totalTelat],
            [''],
            ['Diekspor pada', Carbon::now()->translatedFormat('d F Y, H:i') . ' WIB'],
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        // Merge title
        $sheet->mergeCells('A1:B1');

        return [
            // Judul utama
            1 => [
                'font' => ['bold' => true, 'size' => 16, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '9CAF88']],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            ],
            // Header section
            3 => [
                'font' => ['bold' => true, 'size' => 12, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '8C8C8C']],
            ],
            10 => [
                'font' => ['bold' => true, 'size' => 12, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '8C8C8C']],
            ],
            // Label kolom A
            'A4:A8'   => ['font' => ['bold' => true]],
            'A11:A13' => ['font' => ['bold' => true]],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 25,
            'B' => 45,
        ];
    }
}