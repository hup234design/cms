<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css','resources/js/app.js'])
    @livewireStyles
</head>
<body>
<x-cms-app-header />
@isset($header)
    {{ $header }}
@endisset
<main class="my-16">
    {{ $slot }}
</main>
<x-cms-app-footer />
@livewireScripts
</body>
</html>

