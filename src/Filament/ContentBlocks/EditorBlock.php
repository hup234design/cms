<?php

namespace Hup234design\Cms\Filament\ContentBlocks;

use Filament\Forms;
use Filament\Forms\Components\Builder\Block;
use FilamentTiptapEditor\TiptapEditor;
use Hup234design\Cms\Filament\Support\FormComponents;

class EditorBlock extends ContentBlock
{
    public bool $core = true;

    public static function getBlockSchema(): Block
    {
        return Block::make('editor-block')
            ->label('Editor')
            ->schema([
                ...FormComponents::contentBlockTitle(),
                TiptapEditor::make('content')
                    ->profile('custom')
                    ->maxContentWidth('full'),
            ]);
    }
}
