<?php

namespace Hup234design\Cms\Filament\Blocks;

use Awcodes\Curator\Components\Forms\CuratorPicker;
use Awcodes\Curator\Models\Media;
use Filament\Forms\Components\Builder\Block;
use Hup234design\Cms\ContentBlocks\ContentBlock;

class ImageBlock extends ContentBlock
{
    public bool $core = true;

    public function setData($data): array {
        $media = Media::find($data['image_id']);
        return ['media' => $media];
    }

    public static function getBlockSchema(): Block
    {
        return Block::make('image-block')
            ->schema([
                CuratorPicker::make('image_id')
                    ->label('Image')
                    //->buttonLabel('buttonLabel')
                    ->size('lg')
                    ->constrained(true)
                    ->preserveFilenames()
            ]);
    }
}
