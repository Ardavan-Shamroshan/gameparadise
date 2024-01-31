@php
    $swiperDataOne = [
    'autoplay'       => ['delay' => 3000, 'disableOnInteraction' => false],
    'slidesPerView'  => 2,
    'spaceBetween'   => 10,
    'loop'           => true,
    'observer'       => true,
    'observeParents' => true,
    'breakpoints'    => [
        '320'  => ['slidesPerView' => 2],
        '480'  => ['slidesPerView' => 3],
        '500'  => ['slidesPerView' => 3],
        '768'  => ['slidesPerView' => 4, 'spaceBetween' => 10],
        '1024' => ['slidesPerView' => 4, 'spaceBetween' => 10],
        '1300' => ['slidesPerView' => 5, 'spaceBetween' => 10],
    ],
];
@endphp


<x-home.layout>


    <x-home.breadcrumb>
        <x-slot:breadcrumbs>
            <li class="icon-keyboard_arrow_left"><a href="{{ route('home') }}"> خانه </a></li>
            <li class="icon-1"><a href="{{ route('game-net.games') }}"> اکانت قانونی بازی </a></li>
        </x-slot:breadcrumbs>
    </x-home.breadcrumb>

    @if($gameSlide)
        <div class="flat-pages-title py-0">
            <div class="widget-bg-line">
                <div class="wraper">
                    <div class="bg-grid-line">
                        <div class="bg-line"></div>
                    </div>
                </div>
            </div>
            <div class="themesflat-container w1490">
                <div class="row">
                    <div class="col-12 pages-title">
                        <div class="relative">
                            <div class="swiper swiper-3d-8">
                                <div class="swiper-wrapper">
                                    @forelse($gameSlide->slides as $slide)
                                        <x-home.banner-slide :slide="$slide"/>
                                    @empty
                                    @endforelse
                                </div>
                                <div class="swiper-pagination pagination-number" x-show="Light === false"></div>
                            </div>
                            <div class="swiper-button-next next-3d over"></div>
                            <div class="swiper-button-prev prev-3d over"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="tf-section-3 discover-item ">
        <div class="themesflat-container">
            <livewire:games-filter :pagination="true" :per-load="32"/>
        </div>
    </div>

    <x-home.footer/>

</x-home.layout>