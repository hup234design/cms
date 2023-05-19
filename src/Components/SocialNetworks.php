<?php

namespace Hup234design\Cms\Components;

use Hup234design\Cms\Models\SocialNetwork;
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
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $social_networks = SocialNetwork::active()->get();

        return view('cms::components.social-networks', [
            'social_networks' => $social_networks
        ]);
    }
}
