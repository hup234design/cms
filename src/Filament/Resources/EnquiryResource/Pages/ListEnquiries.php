<?php

namespace Hup234design\Cms\Filament\Resources\EnquiryResource\Pages;

use Filament\Tables\Filters\Layout;
use Hup234design\Cms\Filament\Resources\EnquiryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEnquiries extends ListRecords
{
    protected static string $resource = EnquiryResource::class;

    protected function getTableFiltersLayout(): ?string
    {
        return Layout::AboveContent;
    }
}
