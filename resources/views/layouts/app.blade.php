<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css','resources/js/app.js'])
    @livewireStyles
</head>
<body>
<div class="my-8 text-center">
    <h1 class="text-3xl font-bold underline">
        {{ $page->title }}
    </h1>
    <div class="mt-8">
        {!! $page->content !!}
    </div>
    <div class="mt-8 text-sm text-gray-500">
        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
    </div>
</div>
@livewireScripts
</body>
</html>
