@aware(['record'])

<div class="w-full">
    <div class="">
        @if($data['slider'] ?? false)
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
                 class="relative"
            >
                <div class="swiper-container w-full h-full" x-ref="container">
                    <div class="swiper-wrapper h-full ">
                        @foreach($data['slider']->slides as $slide)
                            <div class="swiper-slide max-w-full bg-gray-300 ">
                                <div class="container py-8">
                                <div class="bg-gray-500  h-96 flex items-center justify-center">
    {{--                            <span class="font-bold text-white">--}}
    {{--                                {{ $slide->heading }}--}}
    {{--                            </span>--}}
                                </div>
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
</div>
