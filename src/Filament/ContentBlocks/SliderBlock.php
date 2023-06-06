<?php

namespace Hup234design\Cms\Filament\ContentBlocks;

use Filament\Forms;
use Filament\Forms\Components\Builder\Block;
use Hup234design\Cms\Contracts\ContentBlockTemplate;
use Hup234design\Cms\Models\Slider;

class SliderBlock extends ContentBlock implements ContentBlockTemplate
{
    public bool $core = true;

    public static function getBlockName(): string
    {
        return "slider-block";
    }

    public static function getBlockLabel(): string
    {
        return "Slider";
    }

    public function setData($data): array {
        $slider = Slider::with('slides')->find($data['slider_id']);
        return ['slider' => $slider];
    }

    public static function getBlockFields(): array
    {
        return [
            Forms\Components\Select::make('slider_id')
                    ->options(Slider::pluck('title','id'))
                    ->required()
            ];
    }
}
