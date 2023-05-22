<?php

namespace Hup234design\Cms\Filament\Blocks;

use Filament\Forms;
use Hup234design\Cms\Models\Slider;
use Livewire\Component;

class SliderBlock extends Component
{
    public $data;

    public static function schema(): Forms\Components\Builder\Block
    {
        return Forms\Components\Builder\Block::make('slider-block')
            ->schema([
                Forms\Components\Select::make('slider_id')
                    ->options(Slider::pluck('title','id'))
                    ->required()
            ]);
    }

    public function mount($data) {
        $this->data = $data;
    }

    public function render()
    {
        ray( $this->data );

        $slider = Slider::with('slides')->find($this->data['slider_id']);
        return view('cms::blocks.slider-block', [
            'slider' => $slider
        ]);
    }
}
