<div class="container">

    @section('headingTitle', 'EVENTS')

    <div class="lg:flex lg:gap-16">
        <div class="lg:flex-1">
            {{ $slot }}
        </div>
        <div class="mt-16 lg:w-80 lg:mt-0 bg-gray-300 p-4">
            <div class="space-y-4">
                <p>Upcoming Events</p>
                @forelse($upcoming_events as $upcoming_event)
                    <p>
                        <a href="{{ route('events.event', $upcoming_event->slug) }}">
                            {{ $upcoming_event->title }}
                        </a>
                    </p>
                @empty
                    <p>no upcoming events</p>
                @endforelse
        </div>
    </div>
</div>

