@aware(['record'])

@if($data['media'])
    <div class="container">
        @if ($data['media']->hasCuration('banner'))
            <x-curator-curation :media="$data['media']" curation="banner" />
        @else
            <x-curator-glider
                class="w-full"
                :media="$data['media']"
            />
        @endif
    </div>
@endif
