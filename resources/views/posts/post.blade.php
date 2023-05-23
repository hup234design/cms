<x-cms-app-layout>
    <x-cms-posts-layout>
        <div class="prose max-w-none">
            <h1>
                {{ $post->title }}
            </h1>
            {!! $post->content !!}
        </div>
    </x-cms-posts-layout>
</x-cms-app-layout>
