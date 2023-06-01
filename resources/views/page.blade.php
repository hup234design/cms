<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css','resources/js/app.js'])
    @livewireStyles
</head>
<body>
    <div class="py-8 max-w-7xl mx-auto">
    <div class="prose max-w-none">
        <h1>
            {{ $record->title }}
        </h1>
        {!! $record->content !!}
    </div>



        <x-cms-content-blocks :blocks="$record->content_blocks" />

    <div class="mt-8 text-sm text-gray-500">
        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
    </div>
</div>
@livewireScripts
</body>
</html>
