<?php

namespace Hup234design\Cms\Filament\Resources\EventResource\Pages;

use Hup234design\Cms\Filament\Resources\EventResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEvents extends ListRecords
{
    protected static string $resource = EventResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Create')
                ->icon('heroicon-s-plus'),
        ];
    }
}
