<?php

namespace Hup234design\Cms;

use Filament\PluginServiceProvider;
use Spatie\LaravelPackageTools\Package;

class CmsServiceProvider extends PluginServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('cms');
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
}
