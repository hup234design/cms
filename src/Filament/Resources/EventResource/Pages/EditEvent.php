<?php

namespace Hup234design\Cms\Filament\Resources\EventResource\Pages;

use Hup234design\Cms\Filament\Resources\EventResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEvent extends EditRecord
{
    protected static string $resource = EventResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
