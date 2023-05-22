<?php

namespace Hup234design\Cms\Components;

use Hup234design\Cms\Support\NavigationMenuLinks;
use Illuminate\View\Component;
use RyanChandler\FilamentNavigation\Facades\FilamentNavigation;

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
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        //$model = FilamentNavigation::getModel();

        $primary_header   = cms_settings('primary_header_menu_id');
        $secondary_header = cms_settings('secondary_header_menu_id');

        return view('cms::components.app-header', [
            'primary_header'   => $primary_header   ? NavigationMenuLinks::format($primary_header)   : null,
            'secondary_header' => $secondary_header   ? NavigationMenuLinks::format($secondary_header)   : null,
        ]);
    }
}
