<?php

namespace Hup234design\Cms\Components;

use Closure;
use Hup234design\Cms\Models\SocialNetwork;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SocialNetworks extends Component
{
    /**
     * Create a new component instance.
     *
     * @param string $name
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
        $social_networks = SocialNetwork::active()->get();

        return view('cms::partials.social-networks', [
            'social_networks' => $social_networks
        ]);
    }
}
