<?php

namespace App\Filament\Resources\ProspectResource\Pages;

use App\Filament\Resources\ProspectResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

use Filament\Notifications\Notification;
class CreateProspect extends CreateRecord
{
    protected function getRedirectUrl():string
    {
        return $this->getResource()::getUrl('index');
    }
    protected static string $resource = ProspectResource::class;
    protected function getCreatedNotification(): ?Notification
    {
    $prospect=$this->record;
    return Notification::make()
                    ->title('new prospect created')
                    ->body("prospect with name {$prospect->nom}created!")
                    ->sendToDatabase(auth()->user());
    }


}
