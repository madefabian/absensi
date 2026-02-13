<?php

namespace App\Filament\Resources\Rapats\Pages;

use App\Filament\Resources\Rapats\RapatResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListRapats extends ListRecords
{
    protected static string $resource = RapatResource::class;

    protected static ?string $title = '📋 Kelola Rapat';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('+ Buat Rapat Baru')
                ->icon('heroicon-o-plus')
                ->button(),
        ];
    }

    protected function getTableQuery(): Builder
    {
        return parent::getTableQuery()->upcoming();
    }
}
