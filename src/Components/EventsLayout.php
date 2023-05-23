<?php

namespace Hup234design\Cms\Components;

use Closure;
use Hup234design\Cms\Models\Event;
use Illuminate\Support\Facades\View;
use Illuminate\View\Component;

class EventsLayout extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        $upcoming_events = Event::upcoming()->get();
        return view(View::exists('layouts.events') ? 'layouts.events' : 'cms::layouts.events', [
            'upcoming_events' => $upcoming_events,
        ]);
    }
}
