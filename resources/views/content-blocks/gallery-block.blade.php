@aware(['record'])

<div>

@if(count($data['gallery'] ?? []) > 0)
    <div class="container">
        <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 ">
            @foreach( $data['gallery'] as $media)
                <div class="flex-1">
                    @if ($media->hasCuration('thumbnail'))
                        <x-curator-curation :media="$media" curation="thumbnail" />
                    @else
                        <x-curator-glider
                            class="object-cover object-center w-auto h-full"
                            :media="$media"
                        />
                    @endif
                </div>
            @endforeach
        </div>

    </div>
@endif

</div>
