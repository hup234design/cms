<x-cms-app-layout>

    @section('headingTitle', 'POSTS')

    <div class="container pl-0">



        <div class="lg:flex lg:gap-16">
            <div class="lg:flex-1">
                {{ $slot }}
            </div>
            <div class="mt-16 lg:w-96 lg:mt-0 space-y-8">
                <div class="border border-gray-300 p-4 space-y-4 leading-none">
                <p class="font-bold">Latest Posts</p>
                @foreach($latest_posts as $latest_post)
                    <p>
                        <a href="{{ route('posts.post', $latest_post->slug) }}">
                            {{ $latest_post->title }}
                        </a>
                    </p>
                @endforeach
                </div>

                <div class="border border-gray-300 p-4 space-y-4 leading-none">
                <p class="font-bold">Categories</p>
                @foreach($categories as $category)
                    <div class="flex justify-between items-center">
                        <a href="{{ route('posts.category', $category->slug) }}">
                            {{ $category->title }}
                        </a>
                        <span>( {{ $category->published_posts_count }} )</span>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>

</x-cms-app-layout>

