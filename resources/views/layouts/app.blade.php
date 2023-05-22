<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css','resources/js/app.js'])
    @livewireStyles
</head>
<body>
<x-cms-app-header />
<main class="my-16">
    {{ $slot }}
</main>
<footer class="bg-gray-900 h-24 flex items-center justify-center">
    <span class="text-sm text-gray-100">
        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
    </span>
</footer>
@livewireScripts
</body>
</html>

