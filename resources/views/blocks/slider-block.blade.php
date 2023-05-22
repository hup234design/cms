<div>
    @if($slider)
        <div x-data="{swiper: null}"
             x-init="swiper = new Swiper($refs.container, {
            autoplay: {
                delay: 2000,
            },
            slidesPerView: 1,
            spaceBetween: 0,
            loop: true,
            effect: 'fade',
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            }
         })"
             class="relative h-full"
        >
            <div class="swiper-container h-full" x-ref="container">
                <div class="swiper-wrapper h-full ">
                    @foreach($slider->slides as $slide)
                        <div class="swiper-slide h-full">
                            <div class="h-96 w-full bg-red-900 flex items-center justify-center">
                            <span class="font-bold text-white">
                                {{ $slide->heading }}
                            </span>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    @endif
</div>
