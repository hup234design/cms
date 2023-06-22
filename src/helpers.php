<?php

use Awcodes\Curator\Facades\Curator;
use Illuminate\Support\Facades\View;

// helpers.php

if (!function_exists('cms_settings')) {
    function cms_settings($key = null, $default = null)
    {
        if ($key === null) {
            return app(Hup234design\Cms\CmsSettings::class);
        }
        return app(Hup234design\Cms\CmsSettings::class)->get($key, $default);
    }
}

if (!function_exists('media_curations')) {
    function media_curations()
    {
        $options = [];
        if ($presets = Curator::getCurationPresets()) {
            foreach ($presets as $preset) {
                $options[$preset['key']] = $preset['name'];
            }
        }
        return $options;
    }
}
