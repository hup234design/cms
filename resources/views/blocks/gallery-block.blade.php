<div>
    @if($gallery)
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-4 gap-8">
                @foreach($gallery->images as $image)
                    <div class="h-64 w-full bg-red-900">
                        {{-- --}}
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
