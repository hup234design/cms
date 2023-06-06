<?php

namespace Hup234design\Cms\Filament\Support;

use Filament\Forms;
use Hup234design\Cms\Filament\ContentBlocks\EditorBlock;
use Hup234design\Cms\Filament\ContentBlocks\EditorImageBlock;
use Hup234design\Cms\Filament\ContentBlocks\GalleryBlock;
use Hup234design\Cms\Filament\ContentBlocks\ImageBlock;
use Hup234design\Cms\Filament\ContentBlocks\SliderBlock;

class FormComponents
{
    public static function contentBlockTitle(): array
    {
        return [
            Forms\Components\Toggle::make('include_heading')
                ->default(false)
                ->reactive(),
            Forms\Components\Card::make()
                ->schema([
                    Forms\Components\TextInput::make('heading')
                        ->required()
                        ->hint('Translatable')
                        ->hintColor('primary')
                        ->columnSpan(3),
                    Forms\Components\Select::make('level')
                        ->disablePlaceholderSelection()
                        ->options([
                            'h2' => 'Heading 2',
                            'h3' => 'Heading 3',
                            'h4' => 'Heading 4',
                        ])
                        ->default('h2'),
                ])
                ->columns(4)
            ->hidden(fn (\Closure $get) => !$get('include_heading'))

        ];
    }

    public static function contentBlocks(): array
    {
        return array_merge(
            [
                EditorBlock::getBlockSchema(),
                EditorImageBlock::getBlockSchema(),
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
