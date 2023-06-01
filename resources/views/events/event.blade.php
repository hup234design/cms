<x-cms-app-layout>
    <x-cms-events-layout>
        <div class="prose max-w-none">
            <h1>
                {{ $record->title }}
            </h1>
            {!! $record->content !!}
        </div>
    </x-cms-events-layout>
</x-cms-app-layout>
