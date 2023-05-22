@if ( trim($data['content']) != "")
    <div class="max-w-7xl mx-auto">
        <div class="prose max-w-none">
            {!! $data['content'] !!}
        </div>
    </div>
@endif
