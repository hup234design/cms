<x-cms-app-layout>

    <x-slot name="header">
        <x-cms-header-blocks :blocks="$page->header_blocks" />
    </x-slot>

    <div class="container">
        <div class="prose max-w-none">
            <h1>
                {{ $page->title }}
            </h1>
            {!! $page->content !!}
        </div>
    </div>

    <x-cms-content-blocks :blocks="$page->content_blocks" />

</x-cms-app-layout>
