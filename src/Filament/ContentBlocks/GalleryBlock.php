<?php

namespace Hup234design\Cms\Filament\ContentBlocks;

use Awcodes\Curator\Components\Forms\CuratorPicker;
use Awcodes\Curator\Models\Media;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Textarea;
use Hup234design\Cms\Filament\Support\FormComponents;

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
        $data['gallery'] = $gallery;
        return $data;
    }

    public static function getBlockSchema(): Block
    {
        return Block::make('gallery-block')
            ->label('Gallery')
            ->schema([
                ...FormComponents::contentBlockTitle(),
                Textarea::make('description')
                    ->rows(5),
                CuratorPicker::make('images')
                    ->label('Images')
                    ->buttonLabel('Select Images')
                    ->multiple()
                    ->size('sm')
//                    ->constrained(true)
                    ->preserveFilenames()
            ]);
    }
}
