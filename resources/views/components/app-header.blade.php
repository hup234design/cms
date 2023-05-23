<header class="bg-gray-700">
    <div class="container h-24 flex items-center justify-between">
        <a class="font-bold text-xl text-white">
            {{ config('app.name') }}
        </a>
        <ul class="flex items-center  gap-8">
            @foreach( $primary_header ?? [] as $link)
                <li>
                    <a href="{{ $link['href'] }}" target="{{ $link['target'] }}" class="text-lg text-gray-100 font-semibold">
                        {{ $link['label'] }}
                    </a>
                </li>
            @endforeach
            @foreach( $secondary_header ?? [] as $link)
                <li>
                    <a href="{{ $link['href'] }}" target="{{ $link['target'] }}" class="text-lg text-gray-100 font-semibold">
                        {{ $link['label'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</header>
