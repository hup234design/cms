<?php

namespace Hup234design\Cms\Filament\ContentBlocks;

use Filament\Forms;
use Filament\Forms\Components\Builder\Block;
use FilamentTiptapEditor\TiptapEditor;
use Hup234design\Cms\Contracts\ContentBlockTemplate;
use Hup234design\Cms\Filament\Support\FormComponents;

class EditorBlock extends ContentBlock implements ContentBlockTemplate
{
    public bool $core = true;

    public static function getBlockName(): string
    {
        return "editor-block";
    }

    public static function getBlockLabel(): string
    {
        return "Editor";
    }

    public static function getBlockFields(): array
    {
        return [
            TiptapEditor::make('content')
                ->profile('custom')
                ->maxContentWidth('full'),
        ];
    }
}
