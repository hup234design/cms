@aware(['record'])

@if ( trim($data['content']) != "")
    <div class="container">
        <div class="grid grid-cols-2 gap-16">
            <div class="prose max-w-none">
                @if( ($data['include_heading'] ?? false) && ($data['heading'] ?? false) && ($data['level'] ?? false) )
                    <{{ $data['level'] }}>{{ $data['heading'] }}</{{ $data['level'] }}>
                @endif
                {!! $data['content'] ?? null !!}
            </div>
        <div>
            @if($data['media'] ?? false)
                <div>
                    <x-cms::image :media="$data['media']" :preset="$data['preset'] ?? ''" />
                </div>
            @endif
        </div>
    </div>
@endif
