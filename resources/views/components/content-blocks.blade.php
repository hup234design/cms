<div class="max-w-7xl mx-auto mt-6 space-y-6">
    @foreach( $blocks as $block )
        @livewire($block['type'], ['data' => $block['data']])
    @endforeach
</div>
