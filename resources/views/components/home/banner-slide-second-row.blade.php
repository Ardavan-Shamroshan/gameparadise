@props([
    'slideshow'
])

<div {{ $attributes->class(['tf-section seller pb-20']) }}>
    <div class="themesflat-container">
        <div class="row">
            <div class="col-md-12">
                <div class="swiper-container seller seller-slider2" data-swiper='{"slidesPerView": 4,
                                "spaceBetween": 10,
                                "breakpoints": {
                                    "320": {
                                            "slidesPerView": 2
                                    },
                                    "480": {
                                            "slidesPerView": 2
                                    },
                                    "500": {
                                        "slidesPerView": 2
                                    },
                                    "640": {
                                        "slidesPerView": 4
                                    },
                                    "768": {
                                        "slidesPerView": 4
                                    },
                                    "1070": {
                                        "slidesPerView": 4
                                    }
                                }
                            }'>
                    <div class="swiper-wrapper taxonomies-wrapper justify-center">
                        @forelse($slideshow->slides()->orderBy('sort_order')->get() as $middleSlideSecondRow)
                            <div class="swiper-slide taxonomies-slide">
                                <div class="tf-category text-center p-0">
                                    <div class="card-media border-gray">
                                        @if($middleSlideSecondRow->image)
                                            <img src="{{ asset('storage/' . $middleSlideSecondRow->image) }}" alt="{{ $middleSlideSecondRow->name ?? '' }}">
                                        @endif
                                        <a href="{{ route('slides', ['slide' => $middleSlideSecondRow]) }}" class="blue-btn"><i class="icon-arrow-up-right2"></i></a>
                                    </div>
                                </div>
                            </div>
                        @empty
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
