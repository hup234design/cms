<x-cms-app-layout>

    @section('headingTitle', 'EVENTS')

    <div class="container pl-0">

        <div class="lg:flex lg:gap-16">
            <div class="lg:flex-1">
                {{ $slot }}
            </div>
            <div class="mt-16 lg:w-96 lg:mt-0 space-y-8">
                <div class="border border-gray-300 p-4 space-y-4 leading-none">
                    <p class="font-bold">Upcoming Events</p>
                    @forelse($upcoming_events as $upcoming_event)
                        <p>
                            <a href="{{ route('events.event', $upcoming_event->slug) }}">
                                {{ $upcoming_event->title }}
                            </a>
                        </p>
                    @empty
                        <p>no upcoming events to display</p>
                    @endforelse
                </div>

                <div class="border border-gray-300 p-4 space-y-4 leading-none">
                    <p class="font-bold">Categories</p>
                    @foreach($categories as $category)
                        <div class="flex justify-between items-center">
                            <a href="{{ route('events.category', $category->slug) }}">
                                {{ $category->title }}
                            </a>
                            <span>( {{ $category->published_upcoming_events_count }} )</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</x-cms-app-layout>
