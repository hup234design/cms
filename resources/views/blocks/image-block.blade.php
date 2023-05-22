@if($media)
    <div class="max-w-7xl mx-auto">
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
