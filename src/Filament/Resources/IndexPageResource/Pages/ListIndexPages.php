<?php

namespace Hup234design\Cms\Filament\Resources\IndexPageResource\Pages;

use Hup234design\Cms\Filament\Resources\IndexPageResource;
use Filament\Resources\Pages\ListRecords;

class ListIndexPages extends ListRecords
{
    protected static string $resource = IndexPageResource::class;

    protected function getTableReorderColumn(): ?string
    {
        return 'sort_order';
    }
}
