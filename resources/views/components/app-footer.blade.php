<footer class="bg-gray-900 py-8 flex flex-col items-center justify-center gap-8">
    <p  class="text-md font-semibold text-gray-100">
        {{ config('app.name') }}
    </p>
    <ul class="flex items-center justify-center gap-8">
        @foreach( $primary_footer as $link)
            <li>
                <a href="{{ $link['href'] }}" target="{{ $link['target'] }}" class="text-sm text-gray-200">
                    {{ $link['label'] }}
                </a>
            </li>
        @endforeach
    </ul>
    <p class="text-sm text-gray-300">
        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
    </p>
</footer>
