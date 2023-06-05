@aware(['record'])

<div>

    @if(count($data['gallery'] ?? []) > 0)
        <div class="container">

                @if( $data['include_heading'] && ($data['heading'] ?? '') )
                <div class="prose max-w-none">
                    <{{ $data['level'] }}>{{ $data['heading'] }}</{{ $data['level'] }}>
                    @if( $description = trim($data['description']) )
                        <p>{{ nl2br($description) }}</p>
                    @endif
                </div>
            @endif
            <div class="my-8 grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 ">
                @foreach( $data['gallery'] as $media)
                    <div class="flex-1">
                        <x-cms::image :media="$media" preset="thumbnail" />
                    </div>
                @endforeach
            </div>
@endif

</div>
