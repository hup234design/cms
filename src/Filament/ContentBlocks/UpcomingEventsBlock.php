<?php

namespace Hup234design\Cms\Filament\ContentBlocks;

use Filament\Forms;
use Filament\Forms\Components\Builder\Block;
use Hup234design\Cms\Contracts\ContentBlockTemplate;
use Hup234design\Cms\Models\Event;

class UpcomingEventsBlock extends ContentBlock implements ContentBlockTemplate
{
    public bool $core = true;

    public static function getBlockName(): string
    {
        return "upcoming-events-block";
    }

    public static function getBlockLabel(): string
    {
        return "Upcoming Events";
    }

    public function setData($data): array
    {
        $data['upcoming_events'] = Event::upcoming()->published()->get()->take( $data['events_count'] ?? 3 );
        return parent::setData($data);
    }

    public static function getBlockFields(): array
    {
        return [
            Forms\Components\TextInput::make('heading'),
                Forms\Components\TextInput::make('subheading'),
                Forms\Components\Select::make('events_count')
                    ->options([
                        2 => 2,
                        3 => 3,
                        4 => 4,
                    ])
                    ->default(3)
                    ->required()
            ];
    }
}
