<?php

namespace Hup234design\Cms\Filament\Blocks;

use Awcodes\Curator\Components\Forms\CuratorPicker;
use Awcodes\Curator\Models\Media;
use Filament\Forms;
use Livewire\Component;

class ImageBlock extends Component
{
    public $data;

    public static function schema(): Forms\Components\Builder\Block
    {
        return Forms\Components\Builder\Block::make('image-block')
            ->schema([
                CuratorPicker::make('image_id')
                    ->label('Image')
                    ->buttonLabel('buttonLabel')
                    ->size('lg')
                    ->constrained(true)
                    ->preserveFilenames()
            ]);
    }

    public function mount($data) {
        $this->data = $data;
    }

    public function render()
    {
        $media = Media::find($this->data['image_id']);
        return view('cms::blocks.image-block', [
            'media' => $media
        ]);
    }
}
