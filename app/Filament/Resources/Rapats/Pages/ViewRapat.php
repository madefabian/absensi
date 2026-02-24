<?php

namespace App\Filament\Resources\Rapats\Pages;

use App\Exports\AbsensiExport;
use App\Filament\Resources\Rapats\RapatResource;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Maatwebsite\Excel\Facades\Excel;

class ViewRapat extends ViewRecord
{
    protected static string $resource = RapatResource::class;

    protected static ?string $title = 'Detail Rapat';

    protected function getHeaderActions(): array
    {
        return [
  Action::make('export')
    ->label('📥 Export Excel')
    ->color('success')
    ->icon('heroicon-o-arrow-down-tray')
    ->visible(fn () => $this->record->absensis()->exists())
    ->url(fn () => route('rapat.export', $this->record))
    ->openUrlInNewTab(),

            EditAction::make()
                ->icon('heroicon-o-pencil')
                ->color('warning'),
        ];
    }

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')
                    ->label('👤 Nama')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('jabatan')
                    ->label('💼 Jabatan')
                    ->searchable(),

                TextColumn::make('waktu_scan')
                    ->label('⏰ Waktu Scan')
                    ->dateTime('d/m/Y H:i:s')
                    ->sortable(),

                TextColumn::make('status')
                    ->label('📊 Status')
                    ->badge()
                    ->color(fn (string $state): string => match($state) {
                        'hadir' => 'success',
                        'telat' => 'warning',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match($state) {
                        'hadir' => '✓ Hadir',
                        'telat' => '⏰ Terlambat',
                        default => $state,
                    })
                    ->sortable(),

                ImageColumn::make('tanda_tangan')
                    ->label('✍️ TTD')
                    ->height(50)
                    ->width(80)
                    ->defaultImageUrl(fn ($record) => null)
                    ->visibility('public'),
            ])
            ->defaultSort('waktu_scan', 'asc')
            ->striped()
            ->paginated([5, 10, 25, 50]);
    }
}