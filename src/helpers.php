<?php

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
