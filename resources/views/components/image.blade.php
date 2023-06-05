@props(['media'=>null,'preset'=>''])

@if($media)
    @if ($media->hasCuration($preset))
        <x-curator-curation
            class="w-full"
            :media="$media"
            :curation="$preset"
        />
    @else
        @if($preset)
            <x-curator-glider
                :media="$media"
                fit="crop"
                class="w-full"
                :width="curator()->preset($preset)['width']"
                :height="curator()->preset($preset)['height']"
            />
        @else
            <x-curator-glider
                class="w-full"
                :media="$media"
            />
        @endif
    @endif
@endif
