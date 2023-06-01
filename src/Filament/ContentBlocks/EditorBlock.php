<?php

namespace Hup234design\Cms\Filament\ContentBlocks;

use Filament\Forms;
use Filament\Forms\Components\Builder\Block;
use FilamentTiptapEditor\TiptapEditor;

class EditorBlock extends ContentBlock
{
    public bool $core = true;

    public function setData($data): array {
        $data['thirsty'] = 'Yes - make coffee';
        return $data;
    }

    public static function getBlockSchema(): Block
    {
        return Block::make('editor-block')
            ->schema([
                TiptapEditor::make('content')
                    ->profile('custom')
                    ->maxContentWidth('full'),
            ]);
    }
}
