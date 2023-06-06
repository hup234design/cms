@props(['media'=>null,'preset'=>''])

@if($media)
    @if ($media->hasCuration($preset))
        <x-curator-curation
            :media="$media"
            :curation="$preset"
            {{ $attributes->merge(['class' => 'w-full']) }}
        />
    @else
        @if($preset)
            <x-curator-glider
                :media="$media"
                fit="crop"
                :width="curator()->preset($preset)['width']"
                :height="curator()->preset($preset)['height']"
                {{ $attributes->merge(['class' => 'w-full']) }}
            />
        @else
            <x-curator-glider
                {{ $attributes->merge(['class' => 'w-full']) }}
                :media="$media"
            />
        @endif
    @endif
@endif
