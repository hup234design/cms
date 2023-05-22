<?php

namespace Hup234design\Cms\Filament\Resources\SliderResource\Pages;

use Hup234design\Cms\Filament\Resources\SliderResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSliders extends ListRecords
{
    protected static string $resource = SliderResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->slideOver(),
        ];
    }
}
