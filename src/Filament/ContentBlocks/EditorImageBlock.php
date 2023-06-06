<?php

namespace Hup234design\Cms\Filament\ContentBlocks;

use Awcodes\Curator\Components\Forms\CuratorPicker;
use Awcodes\Curator\Facades\Curator;
use Awcodes\Curator\Models\Media;
use Filament\Forms;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use FilamentTiptapEditor\TiptapEditor;
use Hup234design\Cms\Contracts\ContentBlockTemplate;
use Hup234design\Cms\Filament\Support\FormComponents;
use Illuminate\Support\HtmlString;

class EditorImageBlock extends ContentBlock implements ContentBlockTemplate
{
    public bool $core = true;

    public static function getBlockName(): string
    {
        return "editor-image-block";
    }

    public static function getBlockLabel(): string
    {
        return "Editor + Image";
    }


    public function setData($data): array {
        $media = Media::find($data['image_id']) ?? null ;
        $data['media'] = $media;
        return $data;
    }

    public static function getBlockFields(): array
    {
        return [
            TiptapEditor::make('content')
                ->profile('custom')
                ->maxContentWidth('full'),
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
        ];
    }
}
