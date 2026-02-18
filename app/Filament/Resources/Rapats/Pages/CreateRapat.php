<?php

namespace App\Filament\Resources\Rapats\Pages;

use App\Filament\Resources\Rapats\RapatResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateRapat extends CreateRecord
{
    protected static string $resource = RapatResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('✅ Rapat Berhasil Dibuat')
            ->body('Rapat telah ditambahkan ke database. Anda sekarang dapat menambahkan peserta.')
            ->send();
    }
}
