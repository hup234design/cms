{{--@isset($record->header_blocks)--}}
{{--    <x-slot name="header">--}}
{{--        <x-cms-header-blocks :blocks="$record->header_blocks" />--}}
{{--    </x-slot>--}}
{{--@endisset--}}

<div class="container">
    @isset($record->title)
        <div class="prose max-w-none">
            <h1>{{ $record->title }}</h1>

            @isset($record->content)
                {!! $record->content !!}
            @endisset
        </div>
    @endisset
</div>

@isset($record->content_blocks)
    <x-cms-content-blocks :blocks="$record->content_blocks" />
@endisset
