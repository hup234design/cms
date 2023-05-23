<?php

namespace Hup234design\Cms\Filament\Resources\DownloadResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Hup234design\Cms\Filament\Resources\DownloadResource;

class ListDownloads extends ListRecords
{
    protected static string $resource = DownloadResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make()->slideOver(),
        ];
    }

    protected function getTableReorderColumn(): ?string
    {
        return 'sort_order';
    }
}
