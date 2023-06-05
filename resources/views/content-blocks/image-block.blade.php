@aware(['record'])

<div>
    @if($data['media'])
        <div class="container">
            <div @class([
                'mx-auto',
                'w-full' => $data['width'] == 'full',
                'w-3/4' => $data['width'] == '3/4',
                'w-2/3' => $data['width'] == '2/3',
                'w-1/2' => $data['width'] == '1/2',
                ])
            >
                <x-cms::image :media="$data['media']" :preset="$data['preset'] ?? ''" />
            </div>
            @endif
        </div>
</div>
