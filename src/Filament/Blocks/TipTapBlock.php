<?php

namespace Hup234design\Cms\Filament\Blocks;

use Filament\Forms;
use FilamentTiptapEditor\TiptapEditor;
use Livewire\Component;

class TipTapBlock extends Component
{
    public $data;

    public static function schema(): Forms\Components\Builder\Block
    {
        return Forms\Components\Builder\Block::make('tip-tap-block')
            ->schema([
                TiptapEditor::make('content')
                    ->profile('custom')
                    ->maxContentWidth('full'),
            ]);
    }

    public function mount($data) {
        $this->data = $data;
    }

    public function render()
    {
        return view('cms::blocks.tip-tap-block');
    }
}
