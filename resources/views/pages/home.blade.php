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

        @include('cms::components.content')

    </div>

</x-cms-app-layout>
