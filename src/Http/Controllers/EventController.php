<?php

namespace Hup234design\Cms\Http\Controllers;

use App\Http\Controllers\Controller;
use Hup234design\Cms\Models\Event;
use Hup234design\Cms\Models\EventCategory;
use Illuminate\View\View;

class EventController extends Controller
{
    public function index(): View
    {
        return view('cms::events.index', [
            'events' => Event::published()->upcoming()->paginate(),
        ]);
    }

    public function event($slug): View
    {
        $event = Event::whereSlug($slug)->firstorFail();

        return view('cms::events.event', [
            'record' => $event
        ]);
    }

    public function category($slug): View
    {
        $category = EventCategory::whereSlug($slug)->firstorFail();
        $events = $category->events()->published()->upcoming()->paginate();

        return view('cms::events.category', [
            'category' => $category,
            'events' => $events,
        ]);
    }
}
