<?php

namespace Hup234design\Cms\Filament\Blocks;

use Filament\Forms;
use Filament\Forms\Components\Builder\Block;
use FilamentTiptapEditor\TiptapEditor;
use Hup234design\Cms\ContentBlocks\ContentBlock;

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
                    //->profile('custom')
                    ->maxContentWidth('full'),
            ]);
    }
}
