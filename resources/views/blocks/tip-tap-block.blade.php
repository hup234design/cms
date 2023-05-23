@if ( trim($data['content']) != "")
    <div class="container">
        <div class="prose max-w-none">
            {!! $data['content'] !!}
        </div>
    </div>
@endif
