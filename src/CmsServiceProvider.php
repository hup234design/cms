<?php

namespace Hup234design\Cms;

use Awcodes\Curator\CurationPreset;
use Awcodes\Curator\Facades\Curator;
use Awcodes\Curator\Resources\MediaResource;
use Filament\Facades\Filament;
use Filament\Forms\Components\Select;
use Filament\Navigation\UserMenuItem;
use Filament\PluginServiceProvider;
use Hup234design\Cms\Commands\MakeCmsContentBlockCommand;
use Hup234design\Cms\Components\AppFooter;
use Hup234design\Cms\Components\AppHeader;
use Hup234design\Cms\Components\ContentBlocks;
use Hup234design\Cms\Components\EventsLayout;
use Hup234design\Cms\Components\HeaderBlocks;
use Hup234design\Cms\Components\PostsLayout;
use Hup234design\Cms\Components\SocialNetworks;
use Hup234design\Cms\Filament\ContentBlocks\EditorBlock;
use Hup234design\Cms\Filament\ContentBlocks\EditorImageBlock;
use Hup234design\Cms\Filament\ContentBlocks\GalleryBlock;
use Hup234design\Cms\Filament\ContentBlocks\ImageBlock;
use Hup234design\Cms\Filament\ContentBlocks\LatestPostsBlock;
use Hup234design\Cms\Filament\ContentBlocks\UpcomingEventsBlock;
use Hup234design\Cms\Filament\ContentBlocks\SliderBlock;
use Hup234design\Cms\Filament\Pages\ManageCmsSettings;
use Hup234design\Cms\Filament\Resources\DownloadResource;
use Hup234design\Cms\Filament\Resources\EnquiryResource;
use Hup234design\Cms\Filament\Resources\EventCategoryResource;
use Hup234design\Cms\Filament\Resources\EventResource;
use Hup234design\Cms\Filament\Resources\IndexPageResource;
use Hup234design\Cms\Filament\Resources\SliderResource;
use Hup234design\Cms\Filament\Resources\SocialNetworkResource;
use Hup234design\Cms\Http\Livewire\EnquiryForm;
use Hup234design\Cms\Models\IndexPage;
use Hup234design\Cms\Models\Page;
use Illuminate\Support\Facades\Schema;
use Livewire\Livewire;
use Hup234design\Cms\Components\AppLayout;
use Hup234design\Cms\Filament\Resources\PageResource;
use Hup234design\Cms\Filament\Resources\PostCategoryResource;
use Hup234design\Cms\Filament\Resources\PostResource;
use RyanChandler\FilamentNavigation\Facades\FilamentNavigation;
use RyanChandler\FilamentNavigation\Filament\Resources\NavigationResource;
use Spatie\LaravelPackageTools\Package;

class CmsServiceProvider extends PluginServiceProvider
{

    protected array $resources = [
        IndexPageResource::class,
        PageResource::class,
        PostCategoryResource::class,
        PostResource::class,
        SocialNetworkResource::class,
        EventCategoryResource::class,
        EventResource::class,
        SliderResource::class,
        DownloadResource::class,
        EnquiryResource::class,
    ];

    protected array $pages = [
        ManageCmsSettings::class,
    ];

    public function configurePackage(Package $package): void
    {
        $package
            ->hasCommands([
                MakeCmsContentBlockCommand::class,
            ])
            ->hasConfigFile('cms')
            ->name('cms')
            ->hasViews('cms')
            ->hasRoute('web')
            ->hasViewComponents('cms',
                AppLayout::class,
                PostsLayout::class,
                EventsLayout::class,
                AppHeader::class,
                AppFooter::class,
                HeaderBlocks::class,
                ContentBlocks::class,
                SocialNetworks::class
            );
    }

    public function packageRegistered(): void
    {
        parent::packageRegistered();

        $this->app->singleton(CmsSettings::class, function () {
            return CmsSettings::make(storage_path('app/settings.json'));
        });

        $this->loadMigrationsFrom([
            __DIR__ . '/../database/migrations'
        ]);

        $this->publishes([
            __DIR__ . '/../resources/views/layouts' => resource_path('views/vendor/cms/layouts'),
            __DIR__ . '/../resources/views/pages' => resource_path('views/vendor/cms/pages'),
            __DIR__ . '/../resources/views/posts' => resource_path('views/vendor/cms/posts'),
            __DIR__ . '/../resources/views/events' => resource_path('views/vendor/cms/services'),
            __DIR__ . '/../resources/views/components' => resource_path('views/vendor/cms/components'),
            __DIR__ . '/../resources/views/blocks' => resource_path('views/vendor/cms/blocks'),
        ], 'cms.views');

    }

    public function packageBooted(): void
    {
        parent::packageBooted();

        Filament::serving(function () {
            if (Schema::hasTable('pages')) {
                FilamentNavigation::addItemType('Page', [
                    Select::make('slug')
                        ->label('Pages')
                        ->options(
                            Page::where('visible', true)->pluck('title', 'slug')
                        )
                ]);
                FilamentNavigation::addItemType('Index Page', [
                    Select::make('slug')
                        ->label('Index Pages')
                        ->options(
                            IndexPage::all()->pluck('title','for')
                        )
                ]);
            }

            Filament::registerNavigationGroups([
                'Post Management',
                'Page Management',
                'Event Management',
                'Content Management',
//                'Enquiries',
                'Settings',
            ]);

            NavigationResource::navigationGroup("Content Management");
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

        Curator::curationPresets([
            CurationPreset::make('thumbnail')
                ->label('Thumbnail')
                ->width(400)
                ->height(300)
                ->format('webp')
                ->quality(80),
            CurationPreset::make('header')
                ->label('Header')
                ->width(1920)
                ->height(640),
            CurationPreset::make('featured')
                ->label('Featured')
                ->width(1440)
                ->height(1080),
        ])
        ->navigationGroup('Content Management');

        // Register any livewire components
        Livewire::component('image-block', ImageBlock::class);
        Livewire::component('slider-block', SliderBlock::class);
        Livewire::component('gallery-block', GalleryBlock::class);
        Livewire::component('editor-block', EditorBlock::class);
        Livewire::component('editor-image-block', EditorImageBlock::class);
        Livewire::component('latest-posts-block', LatestPostsBlock::class);
        Livewire::component('upcoming-events-block', UpcomingEventsBlock::class);

        Livewire::component('enquiry-form', EnquiryForm::class);
    }
}
