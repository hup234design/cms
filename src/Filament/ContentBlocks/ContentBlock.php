<?php

namespace Hup234design\Cms\Filament\ContentBlocks;

use Filament\Forms;
use Filament\Forms\Components\Builder\Block;
use Hup234design\Cms\Contracts\ContentBlockTemplate;
use Hup234design\Cms\Filament\Support\FormComponents;
use Livewire\Component;

class ContentBlock extends Component
{
    public $data = [];

    public static function getBlockName(): string
    {
        return "content-block";
    }

    public static function getBlockLabel(): string
    {
        return "Content Block";
    }

    public static function getBlockFields(): array
    {
        return [];
    }


    public bool $core = false;

    public static function schema(): Block {
        return Block::make(static::getBlockName())
            ->label(static::getBlockLabel())
            ->schema([
                Forms\Components\Toggle::make('include_heading')
                    ->default(false)
                    ->reactive(),
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\TextInput::make('heading')
                            ->required()
                            ->hint('Translatable')
                            ->hintColor('primary')
                            ->columnSpan(3),
                        Forms\Components\Select::make('level')
                            ->disablePlaceholderSelection()
                            ->options([
                                'h2' => 'Heading 2',
                                'h3' => 'Heading 3',
                                'h4' => 'Heading 4',
                            ])
                            ->default('h2'),
                    ])
                    ->columns(4)
                    ->hidden(fn (\Closure $get) => !$get('include_heading')),
                Forms\Components\Toggle::make('has_background')
                    ->default(false)
                    ->reactive(),
                Forms\Components\Select::make('background')
                    ->disablePlaceholderSelection()
                    ->options([
                        'white' => 'White',
                        'primary' => 'Primary',
                        'secondary' => 'Secondary',
                        'dark' => 'Dark',
                        'light' => 'Light',
                    ])
                    ->default('transparent')
                    ->columnSpanFull()
                    ->hidden(fn (\Closure $get) => !$get('include_heading')),
                ...static::getBlockFields()
            ]);
    }

//    public static function schemaFields(): Block {
//        return Block::make('content-block')
//            ->schema([
//                //
//            ]);
//    }
//
    public static function getBlockSchema(): Block {
        return Block::make('content-block')
            ->schema([
                //...FormComponents::contentBlockDefaults()
            ]);
    }

    public function setData($data) : array {
        return $this->data = $data;
    }

    public function mount($data = []) {
        $this->data = $this->setData($data);
    }

    public function render()
    {
        return view(($this->core ? 'cms::content-blocks.' : 'content-blocks.') . static::getBlockName(), [
            'data' => $this->data
        ]);
    }
}
