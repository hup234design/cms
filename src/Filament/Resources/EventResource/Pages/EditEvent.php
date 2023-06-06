<?php

namespace Hup234design\Cms\Filament\Resources\EventResource\Pages;

use Hup234design\Cms\Filament\Resources\EventResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Pboivin\FilamentPeek\Pages\Actions\PreviewAction;
use Pboivin\FilamentPeek\Pages\Concerns\HasPreviewModal;

class EditEvent extends EditRecord
{
    use HasPreviewModal;

    protected static string $resource = EventResource::class;

    protected function getActions(): array
    {
        return [
            PreviewAction::make()->color('success'),
        ];
    }

    protected function getPreviewModalView(): ?string
    {
        return 'cms::components.preview';
    }
}
