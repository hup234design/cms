<?php

namespace Hup234design\Cms\Filament\Pages;

use Awcodes\Curator\Components\Forms\CuratorPicker;
use Closure;
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

        $requiredKeys = [
            "site_name" => config('app.name'),
            "header_image_id" => "",
            "posts_slug" => "blog",
            "posts_title" => "Blog",
            "secondary_footer_menu_id" => "",
            "primary_footer_menu_id" => "",
            "secondary_header_menu_id" => "",
            "primary_header_menu_id" => "",
            "contact_email" => "",
            "contact_address" => "",
            "contact_map" => "",
            "enquiries_enabled" => 0,
            "enquiries_max_characters" => "1000",
            "events_enabled" => 0,
            "events_slug" => "events",
            "events_title" => "Events",
            "services_enabled" => 0,
            "services_slug" => "services",
            "services_title" => "Services",
            "testimonials_enabled" => 0,
            "testimonials_slug" => "testimonials",
            "testimonials_title" => "Testimonials"
        ];

        foreach ($requiredKeys as $key=>$value) {
            if (!array_key_exists($key, $this->state)) {
                $this->state[$key] = $value;
            }
        }

        $this->form->fill($this->state);
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
                                        ->required(),
                                    CuratorPicker::make('state.header_image_id')
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
                                ->reactive()
                                ->label('Enabled'),
                            Forms\Components\Group::make()
                                ->schema([
                                    Forms\Components\TextInput::make('state.events_title')
                                        ->label('Title')
                                        ->required(),
                                    Forms\Components\TextInput::make('state.events_slug')
                                        ->label('Slug')
                                        ->required(),
                                ])
                                ->hidden(fn (Closure $get) => intval($get('state.events_enabled')) == 0 ),
                        ]),
                    Forms\Components\Tabs\Tab::make('Services')
                        ->schema([
                            Forms\Components\Toggle::make('state.services_enabled')
                                ->reactive()
                                ->label('Enabled'),
                            Forms\Components\Group::make()
                                ->schema([
                                    Forms\Components\TextInput::make('state.services_title')
                                        ->label('Title')
                                        ->required(),
                                    Forms\Components\TextInput::make('state.services_slug')
                                        ->label('Slug')
                                        ->required(),
                                ])
                                ->hidden(fn (Closure $get) => ! $get('state.services_enabled') ),
                        ]),
                    Forms\Components\Tabs\Tab::make('Testimonials')
                        ->schema([
                            Forms\Components\Toggle::make('state.testimonials_enabled')
                                ->label('Enabled')
                                ->default(true),
                            Forms\Components\TextInput::make('state.testimonials_title')
                                ->label('Title')
                                ->required(),
                            Forms\Components\TextInput::make('state.testimonials_slug')
                                ->label('Slug')
                                ->required(),
                        ]),
                    Forms\Components\Tabs\Tab::make('Enquiries')
                        ->schema([
                            Forms\Components\Toggle::make('state.enquiries_enabled')
                                ->label('Enabled'),
                            Forms\Components\TextInput::make('state.enquiries_max_characters')
                                ->label('Max Characters')
                                ->numeric()
                                ->required()
                                ->minValue(500)
                                ->maxValue(2500)
                                ->step(50),
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
                                ->helperText('This will only be used if configured in site theme'),
                            NavigationSelect::make('state.primary_footer_menu_id')
                                ->label('Primary Footer Menu')
                                ->required(),
                            NavigationSelect::make('state.secondary_footer_menu_id')
                                ->label('Secondary Footer Menu')
                                ->helperText('This will only be used if configured in site theme'),
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
