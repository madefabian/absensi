<?php

namespace App\Filament\Resources\Absensis\Widgets;

use App\Models\Absensi;
use App\Models\Rapat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AbsensiStats extends BaseWidget
{
    public ?array $filters = null;

    protected function getListeners(): array
    {
        return [
            'filament-table-filter-changed' => 'updateFilters',
        ];
    }

    public function updateFilters(array $filters): void
    {
        $this->filters = $filters;
    }

    protected function getStats(): array
    {
        $query = Absensi::query();
        $rapatQuery = Rapat::query();

        $filters = $this->filters ?? [];

        // Filter Status
        $status = $filters['status']['value'] ?? null;
        if (!empty($status)) {
            $query->where('status', $status);
        }

        // Filter Rapat
        $rapatId = $filters['rapat_id']['value'] ?? null;
        if (!empty($rapatId)) {
            $query->where('rapat_id', $rapatId);
            $rapatQuery->where('id', $rapatId);
        }

        // Filter Tanggal
        $from = $filters['tanggal']['from'] ?? null;
        $until = $filters['tanggal']['until'] ?? null;

        if (!empty($from)) {
            $query->whereDate('waktu_scan', '>=', $from);
        }

        if (!empty($until)) {
            $query->whereDate('waktu_scan', '<=', $until);
        }

        return [
            Stat::make('Total Rapat', $rapatQuery->count()),
            Stat::make('Total Data', $query->count()),
            // Stat::make('Hadir', (clone $query)->where('status', 'hadir')->count()),
            // Stat::make('Izin', (clone $query)->where('status', 'izin')->count()),
            // Stat::make('Sakit', (clone $query)->where('status', 'sakit')->count()),
        ];
    }
}