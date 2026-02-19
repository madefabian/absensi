<?php

namespace App\Filament\Resources\Rapats\Schemas;

use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Forms\Components\ViewField;

class RapatForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([

            Forms\Components\TextInput::make('judul')
                ->label('📋 Judul Rapat')
                ->placeholder('Contoh: Rapat Evaluasi Bulanan')
                ->required()
                ->maxLength(255)
                ->prefixIcon('heroicon-o-pencil-square')
                ->helperText('Judul harus deskriptif dan mudah dipahami')
                ->columnSpanFull(),

            Forms\Components\DatePicker::make('tanggal')
                ->label('📅 Tanggal Rapat')
                ->required()
                ->minDate(today())
                ->prefixIcon('heroicon-o-calendar-days')
                ->helperText('Pilih tanggal rapat'),

            Forms\Components\TimePicker::make('jam_mulai')
                ->label('🕐 Jam Mulai')
                ->required()
                ->prefixIcon('heroicon-o-clock'),

            Forms\Components\TimePicker::make('jam_selesai')
                ->label('🕑 Jam Selesai')
                ->required()
                ->prefixIcon('heroicon-o-clock'),

            Forms\Components\TextInput::make('lokasi')
                ->label('📍 Lokasi Rapat')
                ->placeholder('Contoh: Ruang Meeting A, Lantai 2')
                ->required()
                ->prefixIcon('heroicon-o-map-pin')
                ->helperText('Lokasi tempat rapat akan diadakan')
                ->columnSpanFull(),

            Forms\Components\Toggle::make('qr_status')
                ->label('🔲 Aktifkan QR Code Absensi')
                ->helperText('QR code akan digunakan untuk scan absensi peserta saat rapat')
                ->onColor('success')
                ->offColor('danger')
                ->columnSpanFull(),

            ViewField::make('qr_preview')
                ->label('QR Code Preview')
                ->view('filament.table.columns.qr')
                ->dehydrated(false)
                ->visible(fn ($record) => $record !== null)
                ->columnSpanFull(),

        ])->columns(3);
    }
}
