<?php

namespace Hup234design\Cms;

use Filament\Facades\Filament;
use Filament\Navigation\UserMenuItem;
use Filament\PluginServiceProvider;
use Hup234design\Cms\Components\ContentBlocks;
use Hup234design\Cms\Components\SocialNetworks;
use Hup234design\Cms\Filament\Blocks\ImageBlock;
use Hup234design\Cms\Filament\Resources\SocialNetworkResource;
use Livewire\Livewire;
use Hup234design\Cms\Components\AppLayout;
use Hup234design\Cms\Filament\Blocks\TipTapBlock;
use Hup234design\Cms\Filament\Resources\PageResource;
use Hup234design\Cms\Filament\Resources\PostCategoryResource;
use Hup234design\Cms\Filament\Resources\PostResource;
use RyanChandler\FilamentNavigation\Filament\Resources\NavigationResource;
use Spatie\LaravelPackageTools\Package;

class CmsServiceProvider extends PluginServiceProvider
{

    protected array $resources = [
        PageResource::class,
        PostCategoryResource::class,
        PostResource::class,
        SocialNetworkResource::class,
    ];

    public function configurePackage(Package $package): void
    {
        $package
            ->name('cms')
            ->hasViews('cms')
            ->hasRoute('web')
            ->hasViewComponents('cms',
                AppLayout::class,
                ContentBlocks::class,
                SocialNetworks::class
            );
    }

    public function packageRegistered(): void
    {
        parent::packageRegistered();

//        $this->app->singleton(FlatCmsSettings::class, function () {
//            return FlatCmsSettings::make(storage_path('app/settings.json'));
//        });

        $this->loadMigrationsFrom([
            __DIR__ . '/../database/migrations'
        ]);

//        $this->publishes([
//            __DIR__ . '/../resources/views/layouts' => resource_path('views/vendor/cms/layouts'),
//            __DIR__ . '/../resources/views/pages' => resource_path('views/vendor/cms/pages'),
//            __DIR__ . '/../resources/views/posts' => resource_path('views/vendor/cms/posts'),
//            __DIR__ . '/../resources/views/posts' => resource_path('views/vendor/cms/services'),
//            __DIR__ . '/../resources/views/posts' => resource_path('views/vendor/cms/projects'),
//            __DIR__ . '/../resources/views/posts' => resource_path('views/vendor/cms/events'),
//            __DIR__ . '/../resources/views/components' => resource_path('views/vendor/cms/components'),
//        ], 'cms.views');
    }

    public function packageBooted(): void
    {
        parent::packageBooted();

        Filament::serving(function () {
//            if (Schema::hasTable('pages')) {
//                FilamentNavigation::addItemType('Page', [
//                    Select::make('slug')
//                        ->label('Pages')
//                        ->options(
//                            collect([
//                                'home' => 'Home Page',
//                            ])->merge(
//                                Page::pages()->where('is_home', false)->where('is_visible', true)->pluck('title', 'slug')
//                            )
//                        )
//                ]);
//                FilamentNavigation::addItemType('Index Page', [
//                    Select::make('slug')
//                        ->label('Index Pages')
//                        ->options([
//                            'settings' => 'Services',
//                            'projects_slug' => 'Projects',
//                            'events_slug' => 'Evnts',
//                            'testimonials' => 'Testimonials',
//                            'posts' => 'Posts',
//                        ])
//                ]);
//                FilamentNavigation::addItemType('Service', [
//                    Select::make('slug')
//                        ->label('Services')
//                        ->options(
//                            Page::services()->where('is_visible', true)->pluck('title', 'slug')
//                        )
//                ]);
//                FilamentNavigation::addItemType('Project', [
//                    Select::make('slug')
//                        ->label('Projects')
//                        ->options(
//                            Page::projects()->where('is_visible', true)->pluck('title', 'slug')
//                        )
//                ]);
//                FilamentNavigation::addItemType('Event', [
//                    Select::make('slug')
//                        ->label('Upcoming Events')
//                        ->options(
//                            Page::upcomingEvents()->where('is_visible', true)->pluck('title', 'slug')
//                        )
//                ]);
//            }
//
            Filament::registerNavigationGroups([
                'Post Management',
                'Page Management',
//                'Content Management',
//                'Event Management',
//                'Media Management',
//                'Enquiries',
//                'Settings',
            ]);

            NavigationResource::navigationGroup("Settings");
            NavigationResource::navigationSort(1);

            Filament::registerUserMenuItems([
                UserMenuItem::make()
                    ->label('View Site')
                    //->url(route('home'))
                    ->url('/')
                    ->icon('heroicon-s-cog')
            ]);

//            Filament::registerViteTheme('resources/css/filament.css');
//
//            Filament::registerRenderHook(
//                'body.start',
//                fn (): string => Blade::render('@livewire(\'media-image-browser\')'),
//            );
        });

        // Register any livewire components
        Livewire::component('tip-tap-block', TipTapBlock::class);
        Livewire::component('image-block', ImageBlock::class);

        // Livewire::component('enquiry-form', EnquiryForm::class);
    }
}
