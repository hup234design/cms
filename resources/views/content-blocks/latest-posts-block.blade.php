@aware(['record'])

<div class="container">
    <div class="prose max-w-none text-center">
        @isset($data['heading'])
            <h2>{{ $data['heading'] }}</h2>
        @endisset
        @isset($data['subheading'])
            <p class="text-lg">{{ $data['subheading'] }}</p>
        @endisset
    </div>

    <div class="mt-8 space-y-8 lg:flex lg:space-y-0 lg:gap-8">
        @foreach($data['latest_posts'] as $latest_post)
            <div class="border group lg:flex-1">
                <div class="w-full h-64 overflow-hidden">
                    <x-cms::image
                        :media="$latest_post->featured_image"
                        preset="thumbnail"
                        class="object-cover object-center w-full h-64 transition duration-300 group-hover:scale-105 group-hover:ease-in-out"
                    />
                </div>
                <div class="mt-2 prose max-w-none p-4">
                    <h3>{{ $latest_post->title }}</h3>
                    <p class="line-clamp-3">
                        {{ $latest_post->summary }} }}
                    </p>
                    <a href="{{ route('posts.post', $latest_post->slug) }}">
                        Read More
                    </a>
                </div>

            </div>
        @endforeach
    </div>
</div>
