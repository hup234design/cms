<?php

namespace Hup234design\Cms\Filament\ContentBlocks;

use Awcodes\Curator\Components\Forms\CuratorPicker;
use Awcodes\Curator\Facades\Curator;
use Awcodes\Curator\Models\Media;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\ViewField;
use Illuminate\Support\HtmlString;

class ImageBlock extends ContentBlock
{
    public bool $core = true;

    public function setData($data): array {
        ray($data['image_id']);
        $media = Media::find($data['image_id']) ?? null ;
        $data['media'] = $media;

        ray($data);

        return $data;
    }

    public static function getBlockSchema(): Block
    {
        return Block::make('image-block')
            ->label('Image')
            ->schema([
                Placeholder::make('Note')
                    ->label(false)
                    ->content(new HtmlString('<span class="text-sm italic">Please select a single image. There is an open issue with the image picker that allows multiple selctions. If more than one image is selected, only the first image will be used. For multiple please use gallery block.</span>'))
                    ->columnSpanFull(),
                CuratorPicker::make('image_id')
                    ->multiple(false)
                    ->label('Image')
                    ->buttonLabel('Select Image')
                    ->size('lg')
//                    ->constrained(true)
                    ->preserveFilenames()
                    ->reactive()
                    ->columnSpanFull(),
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
                Select::make('width')
                    ->options([
                        'full' => 'Full',
                        '3/4'  => '3/4',
                        '2/3'  => '2/3',
                        '1/2'  => '1/2'
                    ])

            ])
            ->columns(2);
    }
}
