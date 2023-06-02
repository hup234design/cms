<?php

namespace Hup234design\Cms\Filament\ContentBlocks;

use Awcodes\Curator\Components\Forms\CuratorPicker;
use Awcodes\Curator\Facades\Curator;
use Awcodes\Curator\Models\Media;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\ViewField;

class ImageBlock extends ContentBlock
{
    public bool $core = true;

    public function setData($data): array {
        $media = Media::find($data['image_id']);
        $data['media'] = $media;
        return $data;
    }

    public static function getBlockSchema(): Block
    {
        return Block::make('image-block')
            ->schema([
                CuratorPicker::make('image_id')
                    ->label('Image')
                    //->buttonLabel('buttonLabel')
                    ->size('lg')
//                    ->constrained(true)
                    ->preserveFilenames()
                    ->reactive(),
                Group::make()
                    ->schema([

                        Select::make('preset')
                            ->options(function(callable $get) {
                                $options = [];

                                if( $media = $get('image_id') ) {
                                    foreach ( reset($media)['curations'] ?? [] as $curation ) {
                                        $key = $curation['curation']['key'];
                                        $options[ $key ] = 'Curation: ' . $key;
                                    }

                                    ray(reset($media)['curations']);
                                }

                                foreach (Curator::getCurationPresets() as $preset) {
                                    $options[$preset['key']] = 'Preset: ' . $preset['name'];
                                }

                                return $options;
                            }),
                    ])
            ])
            ->columns(2);
    }
}
