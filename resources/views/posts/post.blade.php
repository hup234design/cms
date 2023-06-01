<x-cms-app-layout>
    <x-cms-posts-layout>
        <div class="prose max-w-none">
            <h1>
                {{ $record->title }}
            </h1>
            {!! $record->content !!}
        </div>
    </x-cms-posts-layout>
</x-cms-app-layout>
