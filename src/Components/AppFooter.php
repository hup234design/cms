<?php

namespace Hup234design\Cms\Components;

use Closure;
use Hup234design\Cms\Support\NavigationMenuLinks;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use RyanChandler\FilamentNavigation\Models\Navigation;

class AppFooter extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render():  View|Closure|string
    {
        $primary_footer   = Navigation::find(cms_settings('primary_footer_menu_id'));
        $secondary_footer = Navigation::find(cms_settings('secondary_footer_menu_id'));

        return view('cms::partials.app-footer', [
            'primary_footer'   => $primary_footer   ? NavigationMenuLinks::format($primary_footer->items)   : null,
            'secondary_footer' => $secondary_footer   ? NavigationMenuLinks::format($secondary_footer->items)   : null,
        ]);
    }
}
