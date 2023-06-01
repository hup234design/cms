<?php

namespace Hup234design\Cms\Filament\Blocks;

use Awcodes\Curator\Components\Forms\CuratorPicker;
use Awcodes\Curator\Models\Media;
use Filament\Forms\Components\Builder\Block;
use Hup234design\Cms\ContentBlocks\ContentBlock;

class GalleryBlock extends ContentBlock
{
    public bool $core = true;

    public function setData($data): array {
        $gallery = [];
        foreach($data['images'] ?? [] as $image_id) {
            if( $media = Media::find($image_id)) {
                $gallery[] = $media;
            }
        }
        return ['gallery' => $gallery];
    }

    public static function getBlockSchema(): Block
    {
        return Block::make('gallery-block')
            ->schema([
                CuratorPicker::make('images')
                    ->label('Image')
                    //->buttonLabel('buttonLabel')
                    ->multiple()
                    ->size('sm')
//                    ->constrained(true)
                    ->preserveFilenames()
            ]);
    }
}
