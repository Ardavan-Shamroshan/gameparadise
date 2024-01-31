<x-home.layout>
    @php($firstInStockProduct = $game->account?->accountSkus()?->where('in_stock', true)->first())
    @push('asset')
        <meta name="product_id" content="{{ $game->id }}">
        <meta name="product_name" content="{{ $game->account?->name ?? $game->name ?? '' }}">
        <meta property="og:image" content="{{ asset($game->getMedia('game')->first()?->getUrl('thumb')) }}">
        <meta name="product_price" content="{{  (int) $firstInStockProduct?->price }}">
        {{--        <meta name="product_old_price" content="12234">--}}
        <meta name="availability" content="{{ $firstInStockProduct ? 'instock' : 'outofstock' }}">
    @endpush



    <x-home.breadcrumb>
        <x-slot:breadcrumbs>
            <li class="icon-keyboard_arrow_left"><a wire:navigate.hover href="{{ url('/') }}"> خانه </a></li>
            <li class="icon-keyboard_arrow_left"><a wire:navigate.hover href="{{ route('game-net.games') }}"> گیم نت </a></li>
            <li dir="rtl" class="icon-1"><a> {{ $game->account?->name ?? $game->name ?? '' }} </a></li>
        </x-slot:breadcrumbs>
    </x-home.breadcrumb>

    <div class="tf-section-2 product-detail my-0" dir="rtl">
        <div class="themesflat-container">
            <div class="row">
                <div class="col-md-6">
                    @if($game->image?->first() || $game->cover?->first || $game->getMedia('game')->first()->hasGeneratedConversion('thumb'))
                        <div data-wow-delay="0s" class="wow fadeInLeft tf-card-box style-5">
                            <div class="card-media mb-0">
                                <a href="#">
                                    @empty($game->getMedia('game')->first())
                                        <img src="{{ ($game->cover?->first()->thumbnail_url ?? $game->image?->first()->thumbnail_url) }}" alt="{{ $game->name }}" style="height: auto !important;">
                                    @else
                                        <img src="{{ ($game->getMedia('game')->first()?->getUrl('thumb')) }}" alt="{{ $game->name }}" style="height: auto !important;">
                                    @endempty
                                </a>
                            </div>

                            <livewire:wishlist-button wire:model="morphedTo" wire:key="wishlist-game-detail-{{ $game->id }}" :morphedTo="$game"/>

                            <div class="featured-countdown">
                                <div class="author flex items-center justify-between gap4">
                                    @if($game->publisher?->logo)
                                        <div class="avatar">
                                            <img src="{{ ($game->publisher?->logo?->first()?->thumbnail_url) }}" alt="{{ $game->publisher?->name ?? '' }}">
                                        </div>
                                    @endif
                                    <div class="info">
                                        <h3><a wire:navigate.hover href="#">{{ $game->publisher->name ?? '' }}</a></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="col-md-6">
                    <div data-wow-delay="0s" class="wow fadeInRight infor-product">
                        <h1 class="w-75 h2">{{ $game->account?->name ?? $game->name ?? '' }}</h1>
                        <div class="author flex items-center mb-30">
                            @if($game->publisher)
                                @if($game->publisher?->logo)
                                    <div class="avatar">
                                        <img src="{{ ($game->publisher?->logo?->first()?->thumbnail_url) }}" alt="{{ $game->publisher?->name ?? '' }}">
                                    </div>
                                @endif
                                <div class="info">
                                    <h3><a href="{{ route('taxonomy', ['typeof' => 'publisher', 'id' => $game->publisher]) }}">{{ $game->publisher->name ?? '' }}</a></h3>
                                </div>
                            @endif

                        </div>
                        <livewire:select-game-account wire:key="select-game-account-key" :$game/>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="featured py-10 swiper-container carousel3 product-item border-gray bg-dark-transparent" data-swiper='{
                               "loop":true,
                                "slidesPerView": 1,
                                "observer": true,
                                "observeParents": true,
                                "spaceBetween": 0,
                                "centeredSlides": true,
                                "breakpoints": {
                                    "768": {
                                        "slidesPerView": 2,
                                        "spaceBetween": 0
                                    },
                                    "1024": {
                                        "slidesPerView": 3,
                                        "spaceBetween": 0
                                    },
                                    "1300": {
                                        "slidesPerView": 4,
                                        "spaceBetween": 0
                                    }
                                },
                                "autoplay": { "delay":2000, "disableOnInteraction": false },
                                "freeMode": true,
                                "watchSlidesProgress": true
                            }'>
                        <div class="swiper-wrapper">
                            @if($game->image)
                                @php($game->image?->forget(0))
                                @forelse($game->image as $image)
                                    <div class="swiper-slide p-2">
                                        <div class="tf-card-collection style-1 relative">
                                            <div class="image">
                                                <img src="{{ $image->thumbnail_url ?? $image->url }}" alt="{{ $game->account?->name ?? $game->name ?? '' }}" style="height: 204px !important;width: 700px !important;">
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                @endforelse
                            @endif
                            @forelse($game->getMedia() as $image)
                                @php($game->getMedia()->forget(0))
                                <div class="swiper-slide p-2">
                                    <div class="tf-card-collection style-1 relative">
                                        <div class="image">
                                            <img src="{{ $image->getUrl('thumb') }}" alt="{{ $game->account?->name ?? $game->name ?? '' }}" style="height: 204px !important;width: 700px !important;">
                                        </div>
                                    </div>
                                </div>
                            @empty
                            @endforelse
                        </div>
                    </div>
                </div>

                @if($videos->isNotEmpty())
                    <div class="col-md-12">
                        <div class="featured py-10 swiper-container carousel3 product-item border-gray bg-dark-transparent" data-swiper='{
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
                                @foreach($videos as $video)
                                    <div class="swiper-slide">
                                        <div class="tf-card-collection style-1 relative p-1">
                                            <div class="image">
                                                @if($video->uploaded)
                                                    <video controls class="w-100 h-100 mb-0" preload="none">
                                                        <source src="{{ asset('uploads/media/' . $video->cover?->first()->thumbnail_url) }}" type="video/mp4">
                                                        <source src="{{ asset('uploads/media/' . $video->cover?->first()->thumbnail_url) }}" type="video/ogg">
                                                        مرورگر شما تگ ویدیو را پشتیبانی نمیکند.
                                                    </video>
                                                @else
                                                    {!!  $video->url  !!}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                <div class="col-md-12">
                    <x-home.product-item class="description border-gray" icon="icon-description" title="توضیحات">
                        <x-slot:content>
                            <div class="tf-section tf-blog-detail py-5">
                                <div class="themesflat-container">
                                    <div class="row">
                                        <div class="wrapper col-md-12" dir="rtl">
                                            <div class="inner-content mr-20">
                                                <div class="inner-post text">
                                                    {!! $game->description !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </x-slot:content>
                    </x-home.product-item>
                </div>

                <div class="divider style-1"></div>

                <div class="col-md-12">
                    <div class="bottom flex justify-content-between items-center gap4 my-5">
                        @if($game->tags->isNotEmpty())
                            @php($tags = $game->tags->pluck('name'))
                            <x-home.tag :tags="$tags"/>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="tf-section tf-blog-detail pb-48">
        <div class="themesflat-container">
            <div class="row">
                <div class="wrapper col-md-12" dir="rtl">
                    <div class="inner-content mr-20">

                        <div class="widget-comment">
                            <div class="d-flex flex-row-reverse justify-content-between">
                                <livewire:ratings :morphedTo="$game" content="شما هم به این بازی امتیاز دهید"/>

                                <h3>({{ $game->comments?->count() ?? 0 }}) دیدگاه </h3>
                            </div>

                            <ul>
                                @forelse($comments as $comment)
                                    <x-home.comment-box :comment="$comment"/>
                                    @forelse($comment->approvedReplies() as $reply)
                                        <x-home.comment-box class="rep" :comment="$reply"/>
                                    @empty
                                    @endforelse
                                @empty
                                @endforelse
                                @forelse($userPendingComments as $userPendingComment)
                                    <x-home.comment-box :pending="true" :comment="$userPendingComment"/>
                                @empty
                                @endforelse
                            </ul>
                        </div>

                        <div class="widget-reply mt-5">
                            @guest
                                <x-home.guest-comment-form/>
                            @endguest
                            @auth
                                <h3 class="heading">دیدگاه خود را ثبت کنید</h3>
                                <p>ایمیل شما نمایش داده نخواهد شد. موارد الزامی با * مشخص شده اند</p>
                                <x-home.authenticated-comment-form :model="$game"/>
                            @endauth
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @if($relatedGames->isNotEmpty())
        <div class="tf-section-2 featured-item style-bottom">
            <div class="themesflat-container">
                <div class="row">
                    <div class="col-md-12" dir="rtl">
                        <div class="heading-section pb-20">
                            <h1>بازی های مرتبط</h1>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="featured pt-10 swiper-container carousel" data-swiper='{
                                "loop":false,
                                "slidesPerView": 1,
                                "observer": true,
                                "observeParents": true,
                                "spaceBetween": 30,
                                "navigation": {
                                    "clickable": true,
                                    "nextEl": ".slider-next",
                                    "prevEl": ".slider-prev"
                                },
                                "pagination": {
                                    "el": ".swiper-pagination",
                                    "clickable": true
                                },
                                "breakpoints": {
                                    "768": {
                                        "slidesPerView": 2,
                                        "spaceBetween": 30
                                    },
                                    "1024": {
                                        "slidesPerView": 3,
                                        "spaceBetween": 30
                                    },
                                    "1300": {
                                        "slidesPerView": 4,
                                        "spaceBetween": 30
                                    }
                                }
                            }'>
                            <div class="swiper-wrapper">
                                @forelse($relatedGames as $relatedGame)
                                    <div class="swiper-slide">
                                        <x-home.game-card :model="$relatedGame->game" :$loop/>
                                    </div>
                                @empty
                                @endforelse
                            </div>
                            <div class="swiper-pagination"></div>
                            <div class="slider-next swiper-button-next"></div>
                            <div class="slider-prev swiper-button-prev"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <x-home.footer/>
</x-home.layout>