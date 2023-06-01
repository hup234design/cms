<x-cms-app-layout>

    <x-slot name="header">
        <x-cms-header-blocks :blocks="$record->header_blocks" />
    </x-slot>

    <div class="container">
        <div class="prose max-w-none">
            <h1>
                {{ $record->title }}
            </h1>
            {!! $record->content !!}
        </div>
    </div>

    <x-cms-content-blocks :blocks="$record->content_blocks" />

</x-cms-app-layout>
