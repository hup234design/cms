@aware(['record'])


<div>
    @if($data['media'])
        <div class="container">

            @if ($data['media']->hasCuration($data['preset'] ?? ''))
                <x-curator-curation
                    class="w-full"
                    :media="$data['media']"
                    :curation="$data['preset']"
                />
            @else
                @isset($data['preset'])
                    <x-curator-glider
                        :media="$data['media']"
                        fit="crop"
                        class="w-full"
                        :width="curator()->preset($data['preset'])['width']"
                        :height="curator()->preset($data['preset'])['height']"
                    />
                @else
                    <x-curator-glider
                        class="w-full"
                        :media="$data['media']"
                    />
                @endisset
            @endif
        </div>
    @endif
</div>
