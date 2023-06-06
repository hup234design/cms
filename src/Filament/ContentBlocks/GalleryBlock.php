<?php

namespace Hup234design\Cms\Filament\ContentBlocks;

use Awcodes\Curator\Components\Forms\CuratorPicker;
use Awcodes\Curator\Models\Media;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Textarea;
use Hup234design\Cms\Contracts\ContentBlockTemplate;
use Hup234design\Cms\Filament\Support\FormComponents;

class GalleryBlock extends ContentBlock implements ContentBlockTemplate
{
    public bool $core = true;

    public static function getBlockName(): string
    {
        return "gallery-block";
    }

    public static function getBlockLabel(): string
    {
        return "Gallery";
    }

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

    public static function getBlockFields(): array
    {
        return [
            Textarea::make('description')
                    ->rows(5),
                CuratorPicker::make('images')
                    ->label('Images')
                    ->buttonLabel('Select Images')
                    ->multiple()
                    ->size('sm')
//                    ->constrained(true)
                    ->preserveFilenames()
            ];
    }
}
