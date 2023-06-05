@props(['slider' => null])

<div class="w-full">
    <div class="">
        @if($slider)
            <div x-data="{swiper: null}"
                 x-init="swiper = new Swiper($refs.container, {
                autoplay: {
                    delay: 10000,
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
                        @foreach($slider->slides as $slide)
                            <div class="swiper-slide max-w-full">

                                @if( $slide->media )
                                    <x-curator-glider
                                        :media="$slide->media"
                                        fit="crop"
                                        class="absolute object-cover object-center w-full h-full"
                                        :width="curator()->preset('header')['width']"
                                        :height="curator()->preset('header')['height']"
                                    />
                                @endif
                                <div class="relative">
                                    <div class="bg-black/50 min-h-[480px] py-16 flex flex-col  items-center justify-center space-y-8">
                                        @if(trim($slide->heading))
                                            <span class="text-2xl text-white font-extrabold md:text-3xl lg:text-4xl xl:text-5xl">{{ $slide->heading }}</span>
                                        @endif
                                        @if(trim($slide->subheading))
                                            <span class="text-lg text-white font-bold md:text-xl lg:text-2xl xl:text-3xl">{{ $slide->subheading }}</span>
                                        @endif
                                        @if(trim($slide->text))
                                            <p class="text-base text-white font-medium lg:text-lg xl:text-xl">{{ nl2br($slide->text) }}</p>
                                        @endif
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
