<x-cms-app-layout>
    <div class="max-w-7xl mx-auto">
        <div class="prose max-w-none">
            <h1>
                {{ $page->title }}
            </h1>
            {!! $page->content !!}
        </div>
    </div>
</x-cms-app-layout>
