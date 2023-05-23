<?php

namespace Hup234design\Cms\Components;

use Closure;
use Hup234design\Cms\Support\NavigationMenuLinks;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use RyanChandler\FilamentNavigation\Models\Navigation;

class AppHeader extends Component
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
        $primary_header   = Navigation::find(cms_settings('primary_header_menu_id'));
        $secondary_header = Navigation::find(cms_settings('secondary_header_menu_id'));

        return view('cms::components.app-header', [
            'primary_header'   => $primary_header   ? NavigationMenuLinks::format($primary_header->items)   : null,
            'secondary_header' => $secondary_header   ? NavigationMenuLinks::format($secondary_header->items)   : null,
        ]);
    }
}
