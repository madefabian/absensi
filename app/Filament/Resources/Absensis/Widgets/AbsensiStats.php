<?php

namespace App\Filament\Resources\Absensis\Widgets;

use App\Models\Absensi;
use App\Models\Rapat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AbsensiStats extends BaseWidget
{
    public ?array $filters = null;

    // ✅ Listen event dari table saat filter berubah
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

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (!empty($filters['rapat_id'])) {
            $query->where('rapat_id', $filters['rapat_id']);
            $rapatQuery->where('id', $filters['rapat_id']);
        }

        if (!empty($filters['tanggal']['from'])) {
            $query->whereDate('waktu_scan', '>=', $filters['tanggal']['from']);
        }

        if (!empty($filters['tanggal']['until'])) {
            $query->whereDate('waktu_scan', '<=', $filters['tanggal']['until']);
        }

        return [
            Stat::make('Total Rapat', $rapatQuery->count()),
            Stat::make('Total Data', $query->count()),
            Stat::make('Hadir', (clone $query)->where('status', 'hadir')->count()),
            Stat::make('Izin', (clone $query)->where('status', 'izin')->count()),
            Stat::make('Sakit', (clone $query)->where('status', 'sakit')->count()),
        ];
    }
}