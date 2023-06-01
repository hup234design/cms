<?php

namespace Hup234design\Cms\Filament\Support;

use Filament\Forms\Components;
use Hup234design\Cms\Filament\ContentBlocks\EditorBlock;
use Hup234design\Cms\Filament\ContentBlocks\GalleryBlock;
use Hup234design\Cms\Filament\ContentBlocks\ImageBlock;
use Hup234design\Cms\Filament\ContentBlocks\SliderBlock;

class FormComponents
{
    public static function contentBlocks(): array
    {
        return array_merge(
            [
                EditorBlock::getBlockSchema(),
                ImageBlock::getBlockSchema(),
                GalleryBlock::getBlockSchema(),
            ],
            config('cms.content_blocks')
        );
    }

    public static function headerBlocks(): array
    {
        return array_merge(
            [
                SliderBlock::getBlockSchema(),
            ],
            config('cms.header_blocks')
        );
    }
}
