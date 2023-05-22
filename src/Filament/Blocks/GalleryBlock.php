<?php

namespace Hup234design\Cms\Filament\Blocks;

use Filament\Forms;
use Hup234design\Cms\Models\Gallery;
use Livewire\Component;

class GalleryBlock extends Component
{
    public $data;

    public static function schema(): Forms\Components\Builder\Block
    {
        return Forms\Components\Builder\Block::make('gallery-block')
            ->schema([
                Forms\Components\Select::make('gallery_id')
                    ->label('Gallery')
                    ->options(Gallery::all()->pluck('title','id'))
            ]);
    }

    public function mount($data) {
        $this->data = $data;
    }

    public function render()
    {
        $gallery = Gallery::find($this->data['gallery_id']);
        return view('cms::blocks.gallery-block', [
            'gallery' => $gallery
        ]);
    }
}
