@aware(['record'])

@if ( trim($data['content']) != "")
    <div class="container">
        <div class="prose max-w-none">
            @if( $data['include_heading'] && ($data['heading'] ?? '') )
                <{{ $data['level'] }}>{{ $data['heading'] }}</{{ $data['level'] }}>
        @endif
        {!! $data['content'] !!}
    </div>
    </div>
@endif
