@aware(['record'])

@if ( trim($data['content']) != "")
    <div class="container">
        <div class="grid grid-cols-2 gap-16">
            <div class="prose max-w-none">
                @if( $data['include_heading'] && ($data['heading'] ?? '') )
                    <{{ $data['level'] }}>{{ $data['heading'] }}</{{ $data['level'] }}>
                @endif
                {!! $data['content'] !!}
            </div>
        <div>
            @if($data['media'])
                <div>
                    <x-cms::image :media="$data['media']" :preset="$data['preset'] ?? ''" />
                </div>
            @endif
        </div>
    </div>
@endif
