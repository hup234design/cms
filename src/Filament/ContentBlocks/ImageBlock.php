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
        $media = Media::find($data['image_id'])?->first();
        $data['media'] = $media;
        return $data;
    }

    public static function getBlockSchema(): Block
    {
        return Block::make('image-block')
            ->schema([
                CuratorPicker::make('image_id')
                    ->helperText('PLease select a single image. There is an open issue with the image picker that allows multiple selctions. If more than one image is selected, only the first image will be used. For multiple please use gallery block.')
                    ->multiple(false)
                    ->label('Image')
                    //->buttonLabel('buttonLabel')
                    ->size('lg')
//                    ->constrained(true)
                    ->preserveFilenames()
                    ->reactive(),
                        Select::make('preset')
                            ->options(function(callable $get) {
                                $options = ['original' => 'Original'];

                                if( $media = $get('image_id') ) {
                                    if( $curations = $media['curations'] ?? false) {
                                        foreach (reset($curations) as $curation) {
                                            $key = $curation['curation']['key'];
                                            $options[$key] = 'Curation: ' . $key;
                                        }
                                    }
                                }
                                if ($presets = Curator::getCurationPresets()) {
                                    foreach ($presets as $preset) {
                                        $options[$preset['key']] = 'Preset: ' . $preset['name'];
                                    }
                                }

                                return $options;
                            }),
            ])
            ->columns(2);
    }
}
