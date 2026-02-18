<?php

namespace App\Filament\Resources\Rapats\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ViewColumn;
use Filament\Tables\Actions\Action;
use Carbon\Carbon;


class RapatsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('judul')
                    ->label('📋 Judul Rapat')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->color('primary')
                    ->wrap(),

                TextColumn::make('tanggal')
                    ->label('📅 Tanggal')
                    ->date('d M Y')
                    ->sortable()
                    ->badge()
                    ->color('info'),

                TextColumn::make('jam_mulai')
                    ->label('🕐 Jam Mulai')
                    ->alignment('center')
                    ->icon('heroicon-o-clock'),

                TextColumn::make('jam_selesai')
                    ->label('🕑 Jam Selesai')
                    ->alignment('center')
                    ->icon('heroicon-o-clock'),

                TextColumn::make('lokasi')
                    ->label('📍 Lokasi')
                    ->searchable()
                    ->icon('heroicon-o-map-pin'),

                IconColumn::make('qr_status')
                    ->label('🔲 QR')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),

                ViewColumn::make('qr')
                    ->label('QR Code')
                    ->view('filament.table.columns.qr'),

            ])
            ->recordUrl(fn ($record) => route('filament.admin.resources.rapats.view', $record))
            ->defaultSort('tanggal', 'asc')
            ->striped();
    }
}
