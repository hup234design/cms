<?php

namespace Hup234design\Cms\Filament\ContentBlocks;

use Filament\Forms;
use Filament\Forms\Components\Builder\Block;
use Hup234design\Cms\Models\Slider;

class SliderBlock extends ContentBlock
{
    public bool $core = true;

    public function setData($data): array {
        $slider = Slider::with('slides')->find($data['slider_id']);
        return ['slider' => $slider];
    }

    public static function getBlockSchema(): Block
    {
        return Block::make('slider-block')
            ->schema([
                Forms\Components\Select::make('slider_id')
                    ->options(Slider::pluck('title','id'))
                    ->required()
            ]);
    }
}
