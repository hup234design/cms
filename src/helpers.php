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
    function media_curations(\Awcodes\Curator\Models\Media $media = null)
    {
        $options = [];
        if( $media ) {
            if( $curations = $media['curations'] ?? false) {
                foreach (reset($curations) as $curation) {
                    $key = $curation['curation']['key'];
                    $options[$key] = 'Curation: ' . $key;
                }
            }
        }
        if ($presets = Curator::getCurationPresets()) {
            foreach ($presets as $preset) {
                if( ! array_key_exists($preset['key'], $options) ) {
                    $options[$preset['key']] = 'Preset: ' . $preset['name'];
                }
            }
        }
        return $options;
    }
}
