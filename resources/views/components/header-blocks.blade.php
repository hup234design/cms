@props(['blocks' => []])

<div class="">
    @foreach( $blocks as $block )
        @livewire($block['type'], ['data' => $block['data']])
    @endforeach
</div>
