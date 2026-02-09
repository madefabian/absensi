<?php

namespace App\Filament\Resources\Rapats\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ViewColumn;


class RapatsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('judul')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('tanggal')
                    ->date()
                    ->sortable(),

                TextColumn::make('jam_mulai'),
                TextColumn::make('jam_selesai'),

                TextColumn::make('lokasi'),

                IconColumn::make('qr_status')
                    ->label('QR Aktif')
                    ->boolean(),

                ViewColumn::make('qr')
                    ->view('filament.table.columns.qr')

            ]);
    }
}
