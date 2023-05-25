<?php

namespace Hup234design\Cms\Filament\Resources\EnquiryBlockResource\Pages;

use Hup234design\Cms\Filament\Resources\EnquiryBlockResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEnquiryBlocks extends ListRecords
{
    protected static string $resource = EnquiryBlockResource::class;

    protected function getActions(): array
    {
        return [
            //Actions\CreateAction::make(),
        ];
    }
}
