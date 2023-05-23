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
        return array_merge(
            [
                TipTapBlock::schema(),
                ImageBlock::schema(),
                GalleryBlock::schema(),
            ],
            config('cms.content_blocks')
        );
    }

    public static function headerBlocks(): array
    {
        return array_merge(
            [
                SliderBlock::schema(),
            ],
            config('cms.header_blocks')
        );
    }
}
