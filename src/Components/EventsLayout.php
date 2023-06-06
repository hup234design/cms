<?php

namespace Hup234design\Cms\Components;

use Closure;
use Hup234design\Cms\Models\Event;
use Hup234design\Cms\Models\EventCategory;
use Illuminate\View\Component;
use Illuminate\View\View;

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
    public function render():  View|Closure|string
    {
        return view('cms::layouts.events', [
            'upcoming_events' => Event::published()->upcoming()->get()->take(5),,
            'categories' => EventCategory::withCount('published_upcoming_events')->get()
        ]);
    }
}
