<?php

namespace Hup234design\Cms\Components;

use Closure;
use Hup234design\Cms\Models\Event;
use Illuminate\Support\View;

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
    public function render(): View
    {
        $upcoming_events = Event::upcoming()->get();
        return view('cms::layouts.events', [
            'upcoming_events' => $upcoming_events,
        ]);
    }
}
