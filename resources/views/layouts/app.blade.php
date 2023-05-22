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
<x-cms-app-footer />
@livewireScripts
</body>
</html>

