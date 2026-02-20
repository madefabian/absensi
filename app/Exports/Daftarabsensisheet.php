<?php

namespace App\Exports;

use App\Models\Rapat;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class DaftarAbsensiSheet implements FromArray, WithTitle, WithStyles, WithColumnWidths, WithEvents
{
    protected Rapat $rapat;

    public function __construct(Rapat $rapat)
    {
        $this->rapat = $rapat;
    }

    public function title(): string
    {
        return 'Daftar Absensi';
    }

    public function array(): array
    {
        $rows = [];

        // Header
        $rows[] = ['No.', 'Nama', 'Jabatan', 'Waktu Scan', 'Status', 'Tanda Tangan'];

        // Data
        $absensis = $this->rapat->absensis()->orderBy('waktu_scan', 'asc')->get();

        foreach ($absensis as $index => $absensi) {
            $rows[] = [
                $index + 1,
                $absensi->nama,
                $absensi->jabatan,
                $absensi->waktu_scan
                    ? Carbon::parse($absensi->waktu_scan)->format('d/m/Y H:i:s')
                    : '-',
                match($absensi->status) {
                    'hadir' => 'Hadir',
                    'telat' => 'Terlambat',
                    default => ucfirst($absensi->status),
                },
                $absensi->tanda_tangan ? '✔ Ada' : '-',
            ];
        }

        return $rows;
    }

    public function styles(Worksheet $sheet): array
    {
        $lastRow = $this->rapat->absensis->count() + 1;

        return [
            1 => [
                'font'      => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill'      => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '9CAF88']],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical'   => Alignment::VERTICAL_CENTER,
                ],
            ],
            'A1:F' . $lastRow => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color'       => ['rgb' => 'CCCCCC'],
                    ],
                ],
                'alignment' => ['vertical' => Alignment::VERTICAL_CENTER],
            ],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 6,
            'B' => 25,
            'C' => 20,
            'D' => 20,
            'E' => 15,
            'F' => 15,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $absensis = $this->rapat->absensis()->orderBy('waktu_scan')->get();
                $row = 2;

                foreach ($absensis as $absensi) {
                    $color = $absensi->status === 'hadir' ? 'E8F5E9' : 'FFF9C4';
                    $event->sheet->getStyle('E' . $row)->applyFromArray([
                        'fill' => [
                            'fillType'   => Fill::FILL_SOLID,
                            'startColor' => ['rgb' => $color],
                        ],
                    ]);

                    $ttdColor = $absensi->tanda_tangan ? 'E8F5E9' : 'FFEBEE';
                    $event->sheet->getStyle('F' . $row)->applyFromArray([
                        'fill' => [
                            'fillType'   => Fill::FILL_SOLID,
                            'startColor' => ['rgb' => $ttdColor],
                        ],
                        'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                    ]);

                    $row++;
                }
            },
        ];
    }
}