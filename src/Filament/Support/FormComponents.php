<?php

namespace Hup234design\Cms\Filament\Support;

use Filament\Forms\Components;
use Hup234design\Cms\Filament\Blocks\GalleryBlock;
use Hup234design\Cms\Filament\Blocks\ImageBlock;
use Hup234design\Cms\Filament\Blocks\SliderBlock;
use Hup234design\Cms\Filament\Blocks\TipTapBlock;

class FormComponents
{
    public static function contentBlocks(): array
    {
        return [
            TipTapBlock::schema(),
            ImageBlock::schema(),
            SliderBlock::schema(),
            GalleryBlock::schema(),
            ...config('cms.blocks'),
        ];
    }
}
