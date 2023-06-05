<?php

namespace Hup234design\Cms\Filament\ContentBlocks;

use Filament\Forms;
use Filament\Forms\Components\Builder\Block;
use Hup234design\Cms\Filament\Support\FormComponents;
use Livewire\Component;

class ContentBlock extends Component
{
    public $data = [];

    public bool $core = false;

    public static function getBlockSchema(): Block {
        return Block::make('content-block')
            ->schema([
                ...FormComponents::contentBlockDefaults()
            ]);
    }

    public function setData($data) : array {
        return $this->data = $data;
    }

    public function mount($data = []) {
        $this->data = $this->setData($data);
    }

    public function render()
    {
        return view(($this->core ? 'cms::content-blocks.' : 'content-blocks.') . static::getBlockSchema()->getName(), [
            'data' => $this->data
        ]);
    }
}
