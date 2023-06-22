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
use Illuminate\Support\Arr;
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
//            Placeholder::make('Note')
//                ->label(false)
//                ->content(new HtmlString('<span class="text-sm italic">Please select a single image. There is an open issue with the image picker that allows multiple selctions. If more than one image is selected, only the first image will be used. For multiple please use gallery block.</span>'))
//                ->columnSpanFull(),
            Forms\Components\Group::make([
                CuratorPicker::make('image_id')
                    ->multiple(false)
                    ->label('Image')
                    ->buttonLabel('Select Image')
                    ->size('lg')
//                    ->constrained(true)
                    ->preserveFilenames()
                    ->reactive(),
                Forms\Components\Group::make([
                    Select::make('preset')
                        ->label('Curation')
                        ->options(media_curations())
                        ->hidden(fn (\Closure $get) => ! $get('image_id')),
                ])
            ])
                ->columns(2)
        ];
    }
}
