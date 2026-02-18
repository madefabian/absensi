<?php

namespace App\Filament\Resources\Rapats\Pages;

use App\Filament\Resources\Rapats\RapatResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\BadgeColumn;

class ViewRapat extends ViewRecord
{
    protected static string $resource = RapatResource::class;

    protected static ?string $title = 'Detail Rapat';

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()
                ->icon('heroicon-o-pencil')
                ->color('warning'),
        ];
    }

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->relationship('absensis')
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

                BadgeColumn::make('status')
                    ->label('📊 Status')
                    ->colors([
                        'success' => 'hadir',
                        'danger' => 'sakit',
                        'warning' => 'izin',
                    ])
                    ->formatStateUsing(fn (string $state): string => match($state) {
                        'hadir' => '✓ Hadir',
                        'sakit' => '🏥 Sakit',
                        'izin' => '📝 Izin',
                        default => $state,
                    })
                    ->sortable(),

                ImageColumn::make('tanda_tangan')
                    ->label('✍️ TTD')
                    ->circular()
                    ->height(50)
                    ->width(50),
            ])
            ->defaultSort('waktu_scan', 'desc')
            ->striped()
            ->paginated([5, 10, 25, 50])
            ->searchable(['nama', 'jabatan']);
    }
}
