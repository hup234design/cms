<?php

namespace Hup234design\Cms\Filament\Resources\PageResource\Pages;

use Hup234design\Cms\Filament\Resources\PageResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Pboivin\FilamentPeek\Pages\Actions\PreviewAction;
use Pboivin\FilamentPeek\Pages\Concerns\HasPreviewModal;

class EditPage extends EditRecord
{
    use HasPreviewModal;

    protected static string $resource = PageResource::class;

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
