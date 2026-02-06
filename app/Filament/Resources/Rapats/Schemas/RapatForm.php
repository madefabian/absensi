<?php

namespace App\Filament\Resources\Rapats\Schemas;

use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ViewField;


class RapatForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Forms\Components\TextInput::make('judul')
                ->required()
                ->maxLength(255),

            Forms\Components\DatePicker::make('tanggal')
                ->required(),

            Forms\Components\TimePicker::make('jam_mulai')
                ->required(),

            Forms\Components\TimePicker::make('jam_selesai')
                ->required(),

            Forms\Components\TextInput::make('lokasi')
                ->required(),

            Forms\Components\Toggle::make('qr_status')
                ->label('QR Aktif')
                ->onColor('success')
                ->offColor('danger'),
            ViewField::make('qr')
                ->label('QR Absensi')
                ->view('filament.rapat.qr')
                ->visible(fn ($record) => $record !== null),

        ]);
    }
}
