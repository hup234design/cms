<?php

namespace Hup234design\Cms\Filament\Pages;

use Awcodes\Curator\Components\Forms\CuratorPicker;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Hup234design\Cms\CmsSettings;
use RyanChandler\FilamentNavigation\Filament\Fields\NavigationSelect;

class ManageCmsSettings extends Page
{
    protected static ?string $navigationGroup = 'Settings';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationIcon = 'heroicon-o-cog';

    protected static ?string $title = 'Settings';

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
                                    CuratorPicker::make('header_image_id')
                                        ->label('Default Header Image')
                                        ->size('lg')
                                        ->constrained(true)
                                        ->preserveFilenames()
                                        ->required()
                                ])
                        ]),
                    Forms\Components\Tabs\Tab::make('Events')
                        ->schema([
                            Forms\Components\Toggle::make('state.events_enabled')
                                ->label('Enabled')
                                ->default(true),
                            Forms\Components\TextInput::make('state.events_title')
                                ->label('Title')
                                ->required(),
                            Forms\Components\TextInput::make('state.events_slug')
                                ->label('Slug')
                                ->required(),
                        ]),
                    Forms\Components\Tabs\Tab::make('Enquiries')
                        ->schema([
                            Forms\Components\Toggle::make('state.enquiries_enabled')
                                ->label('Enabled')
                                ->default(true),
                            Forms\Components\TextInput::make('state.enquiries_max_characters')
                                ->label('Max Characters')
                                ->numeric()
                                ->required()
                                ->minValue(500)
                                ->maxValue(2500)
                                ->step(50)
                                ->default(500),
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
                    Forms\Components\Tabs\Tab::make('Contact')
                        ->schema([
                            Forms\Components\TextInput::make('state.contact_name')
                                ->label('Contact Name')
                                ->nullable(),
                            Forms\Components\TextInput::make('state.contact_email')
                                ->label('Email')
                                ->email()
                                ->nullable(),
                            Forms\Components\TextInput::make('state.contact_telephone')
                                ->label('Telephone')
                                ->nullable(),
                            Forms\Components\Textarea::make('state.contact_address')
                                ->label('Address')
                                ->rows(3)
                                ->nullable(),
                            Forms\Components\Textarea::make('state.contact_map')
                                ->label('Embedded Map Code')
                                ->rows(5)
                                ->nullable(),
                        ]),
                    Forms\Components\Tabs\Tab::make('Navigation')
                        ->schema([
                            NavigationSelect::make('state.primary_header_menu_id')
                                ->label('Primary Header Menu')
                                ->required(),
                            NavigationSelect::make('state.secondary_header_menu_id')
                                ->label('Secondary Header Menu')
                                ->helperText('This will only be used if configured in site theme')
                                ->default(""),
                            NavigationSelect::make('state.primary_footer_menu_id')
                                ->label('Primary Footer Menu')
                                ->required(),
                            NavigationSelect::make('state.secondary_footer_menu_id')
                                ->label('Secondary Footer Menu')
                                ->helperText('This will only be used if configured in site theme')
                                ->default(""),
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
