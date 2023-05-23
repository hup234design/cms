@if($media)
    <div class="container">
        @if ($media->hasCuration('dog'))
            <x-curator-curation :media="$media" curation="dog" />
        @else
            <x-curator-glider
                class="w-full"
                :media="$media"
            />
        @endif
    </div>
@endif
