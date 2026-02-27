<?php

namespace App\Filament\Resources\Absensis\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;

class AbsensisTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('nip')
                    ->label('NIP')
                    ->searchable(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn ($state) => match (strtolower($state)) {
                        'hadir' => 'success',
                        'izin' => 'warning',
                        'sakit' => 'danger',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('rapat.judul')
                    ->label('Rapat')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('waktu_scan')
                    ->label('Waktu Absen')
                    ->dateTime('d M Y H:i:s')
                    ->timezone('Asia/Jakarta')
                    ->sortable(),
            ])

            ->filters([
                SelectFilter::make('status')
                    ->label('Filter Status')
                    ->options([
                        'hadir' => 'Hadir',
                        'izin' => 'Izin',
                        'sakit' => 'Sakit',
                    ]),
            ])

            ->recordActions([
                EditAction::make(),
            ])

            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}