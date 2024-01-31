@php
    $swiperDataOne = [
    'autoplay'       => ['delay' => 3000, 'disableOnInteraction' => false],
    'slidesPerView'  => 2,
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
@endphp

<x-home.layout>
    @push('asset')
        <meta name="product_id" content="{{ $product->id }}">
        <meta name="product_name" content="{{ $product->name }}">
        <meta property="og:image" content="{{ asset($product->getMedia('product')->first()?->getUrl('thumb') ?? $product->cover?->first()->thumbnail_url ?? $product->image?->first()->thumbnail_url) }}">
        <meta name="product_price" content="{{ (int)$product->sku?->price }}">
        {{--        <meta name="product_old_price" content="12234">--}}
        <meta name="availability" content="{{ $product->sku?->in_stock == 0 ? 'outofstock' : 'instock' }}">
    @endpush



    <x-home.breadcrumb>
        <x-slot:breadcrumbs>
            <li class="icon-keyboard_arrow_left"><a wire:navigate.hover href="{{ route('home') }}"> خانه </a></li>
            <li class="icon-keyboard_arrow_left"><a wire:navigate.hover href="{{ route('shop.products') }}"> محصولات </a></li>
            <li><a> {{ $product->name ?? '' }} </a></li>
        </x-slot:breadcrumbs>
    </x-home.breadcrumb>

    <div class="tf-section-2 product-detail my-0" dir="rtl">
        <div class="themesflat-container">
            <div class="row">
                <div class="col-md-6">
                    @if($product->image?->first() || $product->cover?->first || $product->getMedia('product')->first()->hasGeneratedConversion('thumb'))
                        <div data-wow-delay="0s" class="wow fadeInLeft tf-card-box style-5">
                            <div class="card-media mb-0">
                                <a wire:navigate.hover href="#">
                                    @empty($product->getMedia('product')->first())
                                        <img src="{{ asset($product->cover?->first()->thumbnail_url ?? $product->image?->first()->thumbnail_url) }}" alt="{{ $product->name }}" style="height: auto !important;">
                                    @else
                                        <img src="{{ asset($product->getMedia('product')->first()?->getUrl('thumb') ?? $product->cover?->first()->thumbnail_url) }}" alt="{{ $product->name }}" style="height: auto !important;">
                                    @endempty
                                </a>
                            </div>

                            <div class="featured-countdown">
                                <div class="author flex items-center justify-between">
                                    @if($product->brand->logo)
                                        <div class="avatar">
                                            <img src="{{ ($product->brand?->logo?->first()?->thumbnail_url) }}" alt="{{ $product->brand?->name ?? '' }}">
                                        </div>
                                    @endif
                                    <div class="info">
                                        <h3><a wire:navigate.hover href="{{ route('taxonomy', ['typeof' => 'brand', 'id' => $product->brand]) }}">{{ $product->brand->name ?? '' }}</a></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="col-md-6">
                    <div data-wow-delay="0s" class="wow fadeInRight infor-product">
                        <h2>{{ $product->name ?? '' }}</h2>
                        <div class="author">
                            <div class="info">
                                <div class="text">{!! $product->summary ?? '' !!}</div>
                            </div>
                        </div>

                        <livewire:select-product-sku :$product/>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="featured py-10 swiper-container carousel3 product-item" data-swiper='{
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
                                "autoplay": { "delay":5000, "disableOnInteraction": false },
                                "freeMode": true,
                                "watchSlidesProgress": true
                            }'>
                        <div class="swiper-wrapper">
                            @forelse($product->image->forget(0) as $image)
                                <div class="swiper-slide">
                                    <div class="tf-card-collection style-1 relative">
                                        <div class="image">
                                            <img src="{{ $image->thumbnail_url ?? $image->url }}" alt="{{ $product->name ?? '' }}" style="height: 204px !important;width: 700px !important;">
                                        </div>
                                    </div>
                                </div>
                            @empty
                            @endforelse
                            @forelse($product->getMedia()->forget(0) as $image)
                                <div class="swiper-slide">
                                    <div class="tf-card-collection style-1 relative">
                                        <div class="image">
                                            <img src="{{ $image->getUrl('thumb') }}" alt="{{ $product->account?->name ?? $product->name ?? '' }}" style="height: 204px !important;width: 700px !important;">
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
                        <div class="featured py-10 swiper-container carousel3 product-item" data-swiper='{
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
                                        <div class="tf-card-collection style-1 relative">
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
                    <x-home.product-item class="description" icon="icon-description" title="توضیحات">
                        <x-slot:content>
                            <div class="tf-section tf-blog-detail py-5">
                                <div class="themesflat-container">
                                    <div class="row">
                                        <div class="wrapper col-md-12" dir="rtl">
                                            <div class="inner-content mr-20">
                                                <div class="inner-post text">
                                                    {!! $product->description !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </x-slot:content>
                    </x-home.product-item>
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
                                <livewire:ratings :morphedTo="$product" content="شما هم به این کالا امتیاز دهید"/>

                                <h3>({{ $product->comments?->count() ?? 0 }}) دیدگاه </h3>
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
                                <x-home.authenticated-comment-form :model="$product"/>
                            @endauth
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @if($relatedProducts->isNotEmpty())
        <x-home.tf-section-two heading="محصولات مرتبط" dir="ltr">
            <x-home.swiper-container class="featured pt-10 carousel" :data-swiper="$swiperDataOne">
                @forelse($relatedProducts as $relatedProduct)
                    <div class="swiper-slide">
                        <x-home.product-card :model="$relatedProduct" :$loop/>
                    </div>
                @empty
                @endforelse
            </x-home.swiper-container>
        </x-home.tf-section-two>
    @endif

    <x-home.footer/>
</x-home.layout>