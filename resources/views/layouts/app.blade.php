<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css','resources/js/app.js'])
    @livewireStyles
</head>
<body class="antialiased">

<x-cms-app-header />

{{-- HEADING SECTION --}}
@hasSection('slider')
    @yield('slider')
@else
    <div class="relative py-12 bg-gray-300 text-center uppercase text-2xl space-y-6">
        @section('heading')
            <p class="block text-4xl font-bold text-white">
                @yield('headingTitle')
            </p>
            @hasSection('headingSubtitle')
                <p class="block text-2xl font-semibold text-white">
                    @yield('headingSubtitle')
                </p>
            @endif
        @show
    </div>
@endif

@isset($header)
    {{ $header }}
@endisset
<main class="my-12">
    {{ $slot }}
</main>
<x-cms-app-footer />
@livewireScripts
</body>
</html>

