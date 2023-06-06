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

<main class="mt-12">
    <div class="container">
        @isset($record->title)
            <div class="prose max-w-none">
                <h1>{{ $record->title }}</h1>
            </div>
        @endisset
    </div>

    @isset($record->content_blocks)
        <x-cms-content-blocks :blocks="$record->content_blocks" />
    @endisset
</main>
@livewireScripts
</body>
</html>
