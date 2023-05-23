<div>
    @if($gallery)
        <div class="container">
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($gallery->images as $image)
                    <div class="h-64 w-full bg-red-900">
                        {{-- --}}
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
