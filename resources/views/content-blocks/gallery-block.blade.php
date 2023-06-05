@aware(['record'])

<div>

@if(count($data['gallery'] ?? []) > 0)
    <div class="container">
        <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 ">
            @foreach( $data['gallery'] as $media)
                <div class="flex-1">
                    <x-cms::image :media="$media" preset="thumbnail" />
                </div>
            @endforeach
        </div>

    </div>
@endif

</div>
