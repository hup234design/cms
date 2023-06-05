@aware(['record'])

<div>
    @if($data['media'])
        <div class="container">
            <x-cms::image :media="$data['media']" :preset="$data['preset'] ?? ''" />
        </div>
    @endif
</div>
