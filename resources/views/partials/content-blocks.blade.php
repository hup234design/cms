@props(['blocks' => []])

<div class="">
    @foreach( $blocks ?? [] as $block )
        <div class="py-16">
            @livewire($block['type'], ['data' => $block['data']])
        </div>
    @endforeach
</div>
