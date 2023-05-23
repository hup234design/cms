<x-cms-app-layout>
    <x-cms-events-layout>
        <div class="lg:flex-1 prose max-w-none">
            @forelse($events as $event)
                <h3>
                    {{ $event->title }}
                </h3>
                <p>
                    {{ nl2br($event->summary) }}
                </p>
                <p>
                    <a href="{{ route('events.event', $event->slug) }}">Read More</a>
                </p>
            @empty
                <p>no upcoming events</p>
            @endforelse
        </div>
    </x-cms-events-layout>
</x-cms-app-layout>
