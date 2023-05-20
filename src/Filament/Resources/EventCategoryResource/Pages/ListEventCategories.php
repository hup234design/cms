<?php

namespace Hup234design\Cms\Filament\Resources\EventCategoryResource\Pages;

use Hup234design\Cms\Filament\Resources\EventCategoryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEventCategories extends ListRecords
{
    protected static string $resource = EventCategoryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->slideOver(),
        ];
    }

    protected function getTableReorderColumn(): ?string
    {
        return 'sort_order';
    }
}
