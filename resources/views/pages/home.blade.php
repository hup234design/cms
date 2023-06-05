<x-cms-app-layout>

    @if( $record->slider ?? null )
        @section('slider')
            @parent
            <x-cms::slider :slider="$record->slider" />
        @endsection
    @else
        @section('headingTitle', $record->title)
    @endif

    <div class="container">
        <div class="prose max-w-none">
            <h1>
                HOME PAGE
            </h1>
        </div>
    </div>
</x-cms-app-layout>
