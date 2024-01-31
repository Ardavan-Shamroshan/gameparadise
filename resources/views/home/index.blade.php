@php
    $swiperDataOne = [
    'autoplay'       => ['delay' => 3000, 'disableOnInteraction' => false],
    'slidesPerView'  => 4,
    'spaceBetween'   => 30,
    'loop'           => false,
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
$swiperDataTwo = [
    'slidesPerView'  => 10,
    'spaceBetween'   => 0,
    'noSwiping'      => true,
    'noSwipingClass' => 'swiper-slide',
    'breakpoints'    => [
        '320'  => ['slidesPerView' => 5, 'spaceBetween' => 5],
        '480'  => ['slidesPerView' => 5, 'spaceBetween' => 5],
        '500'  => ['slidesPerView' => 5, 'spaceBetween' => 5],
        '640'  => ['slidesPerView' => 10],
        '768'  => ['slidesPerView' => 10],
        '1070' => ['slidesPerView' => 10]
    ],
];

$swiperDataThree = [
    'slidesPerView'  => 4,
    'spaceBetween'   => 10,
    'noSwiping'      => true,
    'noSwipingClass' => 'swiper-slide',
    'breakpoints'    => [
        '320'  => ['slidesPerView' => 2],
        '480'  => ['slidesPerView' => 2],
        '500'  => ['slidesPerView' => 2],
        '640'  => ['slidesPerView' => 4],
        '768'  => ['slidesPerView' => 4],
        '1070' => ['slidesPerView' => 4]
    ],
];
@endphp

<x-home.layout>


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
                    <div class="content pb-1">
                        <h1 data-wow-delay="0s" class="wow fadeInUp m-0" :class="{'text-gray-dark' : Light}" style="font-size: 3rem;font-family: 'valorax', sans-serif;
                                                "><span style="color: #F06100">Game </span> <span style="color: #00BAFF">Paradise</span></h1>
                        <p class="wow fadeInUp mb-3 " :class="{'text-gray-dark' : Light}" data-wow-delay="0.1s">به بهشت بازی خوش آمدید. بهترین بازی ها و کنسول های روز دنیا را اینجا تجربه کنید</p>
                        <div data-wow-delay="0.2s" class=" wow fadeInUp flex justify-center gap4 col-md-12">
                            <x-home.button
                                    href="{{ route('game-net.games') }}"
                                    wire:navigate.hover
                                    class="tf-button style-1 h50 blue-btn"
                                    title="اکانت قانونی بازی"
                                    icon="fa fa-gamepad"
                            />
                            <x-home.button
                                    href="{{ route('shop.products') }}"
                                    wire:navigate.hover
                                    class="tf-button style-1 h50 orange-btn"
                                    title="فروشگاه"
                                    icon="fa fa-cart-shopping"
                            />
                        </div>
                    </div>
                    <div class="icon-background">
                        <img class="absolute item1" src="{{ asset('assets/images/item-background/item-triangle.png') }}" alt="" width="20">
                        <img class="absolute item2" src="{{ asset('assets/images/item-background/item-ps.png') }}" alt="" width="40">
                        <img class="absolute item3" src="{{ asset('assets/images/item-background/item-controller-ps5-white.png') }}" alt="" width="120">
                        <img class="absolute item4" src="{{ asset('assets/images/item-background/item-circle.png') }}" alt="" width="20">
                        <img class="absolute item6" src="{{ asset('assets/images/item-background/item-xbox-controller.png') }}" alt="" width="120">
                        <img class="absolute item7" src="{{ asset('assets/images/item-background/item-gamepass.png') }}" alt="" width="50">
                        <img class="absolute item8" src="{{ asset('assets/images/item-background/item15.png') }}" alt="">
                        <img class="absolute item9" src="{{ asset('assets/images/item-background/item-x.png') }}" alt="" width="20">
                        <img class="absolute item10" src="{{ asset('assets/images/item-background/item-square.png') }}" alt="" width="20">
                    </div>
                    <div class="relative">
                        <div class="swiper swiper-3d-7 pb-0">
                            <div class="swiper-wrapper">
                                @forelse($gamesSlideshow->slides()->orderBy('sort_order')->get() as $gameSlide)
                                    <x-home.swiper-3d-7 :$gameSlide :$loop modal-text="بازی کن"/>
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

    @if($underTopSlideshow)
        <x-home.tf-section>
            <x-home.swiper-container class="seller seller-slider2" :data-swiper="$swiperDataTwo" wrapper-class="flex-wrap">
                @forelse($underTopSlideshow->slides()->orderBy('sort_order')->get() as $underTopSlide)
                    <x-home.publisher-slider :$underTopSlide/>
                @empty
                @endforelse
            </x-home.swiper-container>
        </x-home.tf-section>
    @endif

    @if($consolesCategory)
        <x-home.tf-section-two heading="{{ $consolesCategory->name }}" dir="ltr">
            <x-home.swiper-container class="featured pt-10 carousel" :data-swiper="$swiperDataOne">
                @forelse($consolesCategory?->products as $consoleProduct)
                    @continue($consoleProduct->sku()?->outOfStock()->first())
                    <div class="swiper-slide">
                        <x-home.product-card :model="$consoleProduct" :$loop/>
                    </div>
                @empty
                @endforelse
            </x-home.swiper-container>
        </x-home.tf-section-two>
    @endif

    @if($middleSlideshow)
        <x-home.tf-section>
            <x-home.swiper-container class="seller seller-slider2" :data-swiper="$swiperDataThree" wrapper-class="taxonomies-wrapper">
                @forelse($middleSlideshow->slides()->orderBy('sort_order')->get() as $middleSlide)
                    <x-home.banner-slide :slide="$middleSlide"/>
                @empty
                @endforelse
            </x-home.swiper-container>
        </x-home.tf-section>
    @endif

    <div class="tf-section-3 discover-item ">
        <div class="themesflat-container">
            <livewire:games-filter :per-load="16"/>

            <div>
                <x-home.button
                        href="{{ route('game-net.games') }}"
                        wire:navigate.hover
                        class="tf-button style-1 h50 purple-btn mx-auto"
                        title="مشاهده بیشتر"
                        icon="fa fa-gamepad"
                />
            </div>
        </div>
    </div>

    @if($underMiddleSlideshow)
        <x-home.tf-section>
            <x-home.swiper-container class="seller seller-slider2" :data-swiper="$swiperDataThree" wrapper-class="taxonomies-wrapper">
                @forelse($underMiddleSlideshow->slides()->orderBy('sort_order')->get() as $underMiddleSlide)
                    <x-home.banner-slide :slide="$underMiddleSlide"/>
                @empty
                @endforelse
            </x-home.swiper-container>
        </x-home.tf-section>
    @endif

    @if($accessoriesCategory)
        <x-home.tf-section-two heading="{{ $accessoriesCategory->name ?? '' }}" dir="ltr">
            <x-home.swiper-container class="featured pt-10 carousel" :data-swiper="$swiperDataOne">
                @forelse($accessoriesCategory?->products as $accessoriesProduct)
                    @continue($accessoriesProduct->sku()?->outOfStock()->first())
                    <div class="swiper-slide">
                        <x-home.product-card :model="$accessoriesProduct" :$loop/>
                    </div>
                @empty
                @endforelse
            </x-home.swiper-container>
        </x-home.tf-section-two>
    @endif

    <x-home.tf-section-two heading="نوشته های تازه">
        <x-slot:headingSection><a wire:navigate.hover href="{{ route('content.posts') }}"> جستجوی بیشتر <i class="icon-arrow-left2"></i></a></x-slot:headingSection>
        <x-home.swiper-container class="featured pt-10 carousel" :data-swiper="$swiperDataOne">
            @forelse($recentPosts as $post)
                <div class="swiper-slide" dir="rtl">
                    <x-home.post-card :$post/>
                </div>
            @empty
            @endforelse
        </x-home.swiper-container>
    </x-home.tf-section-two>

    @if($bottomSlideshow)
        <x-home.tf-section>
            <x-home.swiper-container class="seller seller-slider2" :data-swiper="$swiperDataThree" wrapper-class="taxonomies-wrapper">
                @forelse($bottomSlideshow->slides()->orderBy('sort_order')->get() as $bottomSlide)
                    <x-home.banner-slide :slide="$bottomSlide"/>
                @empty
                @endforelse
            </x-home.swiper-container>
        </x-home.tf-section>
    @endif

    @if($giftCardCategory)
        <x-home.tf-section-two heading="{{ $giftCardCategory->name ?? '' }}" dir="ltr">
            <x-home.swiper-container class="featured pt-10 carousel" :data-swiper="$swiperDataOne">
                @forelse($giftCardCategory?->products as $giftCardProduct)
                    @continue($giftCardProduct->sku()?->outOfStock()->first())
                    <div class="swiper-slide">
                        <x-home.product-card :model="$giftCardProduct" :$loop/>
                    </div>
                @empty
                @endforelse
            </x-home.swiper-container>
        </x-home.tf-section-two>
    @endif

    <div class="tf-section top-collections">
        <div class="themesflat-container">
            <div class="row">
                <div class="col-md-12" dir="rtl">
                    <div class="heading-section pt-25 pb-3">
                        <h1>بازی های ناشرین</h1>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="featured pt-10 swiper-container carousel3" data-swiper='{
                    "autoplay": {
                                    "delay": "3000", "disableOnInteraction": false
                                },
                                "loop":false,
                                "slidesPerView": 1,
                                "spaceBetween": 30,
                                "observer": true,
                                "observeParents": true,
                                "breakpoints": {
                                    "600": {
                                        "slidesPerView": 2
                                    },
                                    "991": {
                                        "slidesPerView": 3
                                    }
                                }
                            }'>
                        <div class="swiper-wrapper">

                            @forelse($topPublishers as $publisher)
                                @if($publisher->games && ($publisher->games->count() >= 4))
                                    <x-home.collections :model="$publisher"/>
                                @endif
                            @empty
                            @endforelse

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($middleSlideshowSecondRow)
        <x-home.tf-section>
            <x-home.swiper-container class="seller seller-slider2" :data-swiper="$swiperDataThree" wrapper-class="taxonomies-wrapper">
                @forelse($middleSlideshowSecondRow->slides()->orderBy('sort_order')->get() as $middleSlideSecondRow)
                    <x-home.banner-slide :slide="$middleSlideSecondRow"/>
                @empty
                @endforelse
            </x-home.swiper-container>
        </x-home.tf-section>
    @endif

    <div class="tf-section action">
        <div class="themesflat-container">
            <div class="row">
                <div class="col-md-12">
                    <div class="action__body" :class="{ 'bg-white' : Light }">
                        <div class="tf-tsparticles">
                            <div id="tsparticles1" data-color="#161616" data-line="#000"></div>
                        </div>
                        <h2 dir="rtl">بازی های روز رو از بهشت بازی ما جستجو کن و بازی کن</h2>
                        <div class="flat-button flex">
                            <a wire:navigate.hover href="{{ route('game-net.games') }}" class="tf-button blue-btn style-2 h50 w190 mr-10">اکانت قانونی بازی<i class="fa fa-gamepad"></i></a>
                            <a href="{{ route('shop.products') }}" class="tf-button orange-btn style-2 h50 w230">فروشگاه<i class="fa fa-shopping-cart"></i></a>
                        </div>
                        <div class="bg-home7">
                            <div class="swiper-container autoslider3reverse" data-swiper='{
                                        "loop":true,
                                        "slidesPerView": "auto",
                                        "spaceBetween": 14,
                                        "direction": "vertical",
                                        "speed": 10000,
                                        "observer": true,
                                        "observeParents": true,
                                        "autoplay": {
                                            "delay": "0",
                                            "disableOnInteraction": false
                                        }
                                    }'>
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <img src="{{ asset('assets/images/cards/card-3.png') }}" alt="">
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="{{ asset('assets/images/cards/card-5.png') }}" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-container autoslider4reverse" data-swiper='{
                                        "loop":true,
                                        "slidesPerView": "auto",
                                        "spaceBetween": 14,
                                        "direction": "vertical",
                                        "speed": 10000,
                                        "observer": true,
                                        "observeParents": true,
                                        "autoplay": {
                                            "delay": "0",
                                            "disableOnInteraction": false,
                                            "reverseDirection": true
                                        }
                                    }'>
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <img src="{{ asset('assets/images/cards/card-1.png') }}" alt="">
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="{{ asset('assets/images/cards/card-2.png') }}" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-container autoslider3reverse" data-swiper='{
                                        "loop":true,
                                        "slidesPerView": "auto",
                                        "spaceBetween": 14,
                                        "direction": "vertical",
                                        "speed": 10000,
                                        "observer": true,
                                        "observeParents": true,
                                        "autoplay": {
                                            "delay": "0",
                                            "disableOnInteraction": false
                                        }
                                    }'>
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <img src="{{ asset('assets/images/cards/card-4.png') }}" alt="">
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="{{ asset('assets/images/cards/card-3.png') }}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-home.footer/>
</x-home.layout>