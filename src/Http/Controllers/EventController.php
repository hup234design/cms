<?php

namespace Hup234design\Cms\Http\Controllers;

use App\Http\Controllers\Controller;
use Hup234design\Cms\Models\Event;
use Hup234design\Cms\Models\EventCategory;
use Illuminate\Support\Facades\View;

class EventController extends Controller
{
    public function index()
    {
        return view(View::exists('events.index') ? 'events.index' : 'cms::events.index');
    }

    public function event($slug)
    {
        $event = Event::whereSlug($slug)->firstorFail();

        return view(View::exists('pages.home') ? 'events.event' : 'cms::events.event', [
            'event' => $event
        ]);
    }

    public function category($slug)
    {
        $category = EventCategory::whereSlug($slug)->firstorFail();

        return view(View::exists('events.category') ? 'events.category' : 'cms::events.category', [
            'category' => $category
        ]);
    }
}
