<?php

namespace App\Filament\Resources\Absensis\Pages;

use App\Filament\Resources\Absensis\AbsensiResource;
use App\Filament\Exports\AbsensiExporter;
use App\Filament\Resources\Absensis\Widgets\AbsensiStats;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAbsensis extends ListRecords
{
    protected static string $resource = AbsensiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            AbsensiStats::class,
        ];
    }

    // ✅ Dipanggil otomatis Livewire setiap filter berubah
    public function updatedTableFilters(): void
    {
        $this->dispatch(
            'filament-table-filter-changed',
            filters: $this->getTableFiltersForm()->getRawState()
        );
    }
}