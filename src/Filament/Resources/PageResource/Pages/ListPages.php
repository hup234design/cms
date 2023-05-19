<?php

namespace Hup234design\Cms\Filament\Resources\PageResource\Pages;

use Hup234design\Cms\Filament\Resources\PageResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPages extends ListRecords
{
    protected static string $resource = PageResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
