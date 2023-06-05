
<x-cms-posts-layout>

    @section('headingSubtitle', $category->title)

    <div class="lg:flex-1 prose max-w-none">
        @forelse($posts as $post)
            <h3>
                {{ $post->title }}
            </h3>
            <p>
                {{ nl2br($post->summary) }}
            </p>
            <p>
                <a href="{{ route('posts.post', $post->slug) }}">Read More</a>
            </p>
        @empty
            <p>no posts</p>
        @endforelse
    </div>

</x-cms-posts-layout>
