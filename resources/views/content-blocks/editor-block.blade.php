
@if ( trim($data['content']) != "")
    <div class="container">
        <div class="prose max-w-none">
            @if( ($data['include_heading'] ?? false) && ($data['heading'] ?? false) && ($data['level'] ?? false) )
                <{{ $data['level'] }}>
                    {{ $data['heading'] }}
                </{{ $data['level'] }}>
            @endif
            {!! $data['content'] ?? null !!}
        </div>
    </div>
@endif
