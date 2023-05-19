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
}
