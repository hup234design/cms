<x-cms-app-layout>

    @if( $record->slider ?? null )
        @section('slider')
            @parent
            <x-cms::slider :slider="$record->slider" />
        @endsection
    @else
        @section('headingTitle', $record->title)
    @endif

    @include('cms::components.content')

</x-cms-app-layout>
