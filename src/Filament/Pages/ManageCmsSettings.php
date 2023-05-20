<?php

namespace Hup234design\Cms\Filament\Pages;

use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Hup234design\Cms\CmsSettings;

class ManageCmsSettings extends Page
{
    protected static ?string $navigationGroup = 'Settings';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationIcon = 'heroicon-o-cog';

    protected static ?string $title       = 'Settings';

    protected static string $view = 'cms::filament.pages.cms-settings';

    public $state = [];

    public function mount(CmsSettings $settings)
    {
        $this->state = $settings->all();
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\Tabs::make('Settings')
                ->tabs([
                    Forms\Components\Tabs\Tab::make('General')
                        ->schema([
                            Forms\Components\Group::make()
                                ->schema([
                                    Forms\Components\TextInput::make('state.site_name')
                                        ->label('Site Name')
                                        ->default(config('app.name'))
                                        ->required(),
                                ])
                        ]),
                    Forms\Components\Tabs\Tab::make('Posts')
                        ->schema([
                            Forms\Components\TextInput::make('state.posts_title')
                                ->label('Title')
                                ->required(),
                            Forms\Components\TextInput::make('state.posts_slug')
                                ->label('Slug')
                                ->required(),
                        ]),
                ])
                ->columnSpan(2)
        ];
    }

    public function submit(CmsSettings $settings): void
    {
        $this->validate();
        $settings->put($this->state);

        Notification::make()
            ->title('Settings Saved successfully')
            ->success()
            ->send();
    }
}
