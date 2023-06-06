@props(['blocks' => []])

<div class="mt-8 space-y-16">
    @foreach( $blocks ?? [] as $block )
        @livewire($block['type'], ['data' => $block['data']])
    @endforeach
</div>
