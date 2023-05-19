<div>
    @if($media)
        @if ($media->hasCuration('thumbnail'))
            <x-curator-curation :media="$media" curation="thumbnail" />
        @else
            <x-curator-glider
                class="w-full"
                :media="$media"
            />
        @endif
    @endif
</div>
