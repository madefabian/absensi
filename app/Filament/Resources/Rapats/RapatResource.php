<?php

namespace App\Filament\Resources\Rapats;

use App\Filament\Resources\Rapats\Pages\CreateRapat;
use App\Filament\Resources\Rapats\Pages\EditRapat;
use App\Filament\Resources\Rapats\Pages\ListRapats;
use App\Filament\Resources\Rapats\Schemas\RapatForm;
use App\Filament\Resources\Rapats\Tables\RapatsTable;
use App\Models\Rapat;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class RapatResource extends Resource
{
    protected static ?string $model = Rapat::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'judul';

    public static function form(Schema $schema): Schema
    {
        return RapatForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RapatsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListRapats::route('/'),
            'create' => CreateRapat::route('/create'),
            'edit' => EditRapat::route('/{record}/edit'),
        ];
    }
}
