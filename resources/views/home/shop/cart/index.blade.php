<x-home.layout>
    <x-slot:title>سبد خرید</x-slot:title>
    <x-slot:url>https://gpgaming.ir/</x-slot:url>
    <x-slot:name>گیم پردایس</x-slot:name>



    <x-home.breadcrumb>
        <x-slot:breadcrumbs>
            <li class="icon-keyboard_arrow_left"><a href="{{ route('home') }}" class="ml-3"> خانه </a></li>
            <li dir="rtl" class="icon-1"><a> سبد خرید </a></li>
        </x-slot:breadcrumbs>
    </x-home.breadcrumb>

    <div class="tf-section" dir="rtl">
        <div class="themesflat-container">
            <div class="row">
                <div class="col-12 pages-title">
                    <div class="content-tabs">
                        <div id="create" class="tabcontent active">
                            <div class="wrapper-content-create">
                                <div class="heading-section">
                                    <h2 class="tf-title pb-30">سبد خرید</h2>
                                </div>
                                <div class="widget-tabs relative">
                                    <ul class="widget-menu-tab">
                                        <li class="item-title active">
                                            <span class="inner"><i class="icon-keyboard_arrow_left"></i><span class="order">1</span> سبد خرید </span>
                                        </li>
                                        <li class="item-title">
                                            <span class="inner"><i class="icon-keyboard_arrow_left"></i><span class="order">2</span> زمان و نحوه ارسال </span>
                                        </li>
                                        <li class="item-title">
                                            <span class="inner"><i class="icon-keyboard_arrow_left"></i><span class="order">3</span> پرداخت </span>
                                        </li>
                                    </ul>

                                    <div class="tf-section-5 tf-list-blog">
                                        <div class="themesflat-container">
                                            <div class="row">
                                                <div class="wrap-inner col-md-8">
                                                    <div class="widget-content-tab py-6">
                                                        <div class="active">
                                                            <div class="widget-table-ranking">
                                                                <div data-wow-delay="0s" class="wow fadeInUp table-ranking-heading animated" style="visibility: visible; animation-delay: 0s; animation-name: fadeInUp;">
                                                                    <div class="column">
                                                                        <span>محصول</span>
                                                                    </div>
                                                                    <div class="column">
                                                                        <span>نام</span>
                                                                    </div>
                                                                    <div class="column">
                                                                        <span>نوع</span>
                                                                    </div>
                                                                    {{--                                                                        <div class="column">--}}
                                                                    {{--                                                                            <h3>تخفیف</h3>--}}
                                                                    {{--                                                                        </div>--}}
                                                                    {{--                                                                        <div class="column">--}}
                                                                    {{--                                                                            <h3>سود شما از این خرید</h3>--}}
                                                                    {{--                                                                        </div>--}}
                                                                    <div class="column">
                                                                        <span>قیمت نهایی</span>
                                                                    </div>
                                                                    <div class="column">
                                                                        <span>تعداد</span>
                                                                    </div>
                                                                    <div class="column"><span>عملیات</span></div>
                                                                </div>
                                                                <div class="table-ranking-content">
                                                                    @forelse($cartItems as $cartItem)
                                                                        @if($cartItem->game)
                                                                            <div data-wow-delay="0s" class="wow fadeInUp d-flex justify-between fl-row-ranking animated" style="visibility: visible; animation-delay: 0s; animation-name: fadeInUp;">
                                                                                <div class="column">
{{--                                                                                    <div class="item-rank">{{ $loop->iteration }}.</div>--}}
                                                                                    <div class="item-avatar">
                                                                                        <img class="rounded-85" src="{{ asset($cartItem->game->getMedia('game')->first()?->getUrl('thumb') ?? $cartItem->game->cover?->first()->thumbnail_url ?? $cartItem->game->image?->first()?->thumbnail_url) }}" alt="{{ $cartItem->game->name ?? '' }}" style="width: 6rem;">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="column">
                                                                                    <div class="item-name" style="line-height: 2rem">{{ $cartItem->game->account?->name ?? $cartItem->game->name ?? '' }}</div>
                                                                                </div>
                                                                                <div class="column" style="line-height: 2rem">
                                                                                    {{ $cartItem->accountSku?->volume?->type ?? '' }}
                                                                                </div>
                                                                                {{--                                                                                    <div class="column danger">--}}
                                                                                {{--                                                                                        --}}{{--                                                                                    <h6>-6.5%</h6>--}}
                                                                                {{--                                                                                        <h6>{{ discountFormat(0) }}</h6>--}}
                                                                                {{--                                                                                    </div>--}}
                                                                                {{--                                                                                    <div class="td4 success">--}}
                                                                                {{--                                                                                        <h6>{{ priceFormat(0) }}</h6>--}}
                                                                                {{--                                                                                    </div>--}}
                                                                                <div class="column">
                                                                                    {{--                                                                                    <h6>{{ priceFormat($cartItem->totalPrice) }}</h6>--}}
                                                                                    {{ priceFormat($cartItem->price) }}
                                                                                </div>
                                                                                <div class="column">
                                                                                    {{ $cartItem->number ?? '-' }}
                                                                                </div>
                                                                                <div class="column">
                                                                                    <h3>
                                                                                        <a href="{{ route('shop.cart.remove', $cartItem) }}" class="date text-danger mr-10 cursor-pointer"><i class="fa fa-trash-alt"></i></a>
                                                                                    </h3>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                        @if($cartItem->product)
                                                                            <div data-wow-delay="0s" class="wow fadeInUp fl-row-ranking animated" style="visibility: visible; animation-delay: 0s; animation-name: fadeInUp;">
                                                                                <div class="td3">
                                                                                    <div class="item-avatar">
                                                                                        <img src="{{ asset($cartItem->product->getMedia('product')->first()?->getUrl('thumb') ?? $cartItem->product->cover?->first()->thumbnail_url ?? $cartItem->product->image?->first()?->thumbnail_url) }}" alt="{{ $cartItem->product->name ?? '' }}">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="td3" style="line-height: 2rem">
                                                                                    {{ $cartItem->product->name ?? '' }}
                                                                                </div>
                                                                                <div class="td3">
                                                                                    <div class="item-name">{{ $cartItem->sku->code ?? '' }}</div>
                                                                                </div>
                                                                                 <div class="td3" style="line-height: 2rem">
                                                                                    {{ priceFormat($cartItem->price) }}
                                                                                </div>
                                                                                <div class="td3">
                                                                                    {{ $cartItem->number ?? '-' }}
                                                                                </div>
                                                                                <div class="td3">
                                                                                    <h3>
                                                                                        <a href="{{ route('shop.cart.remove', $cartItem) }}" class="date text-danger mr-10 cursor-pointer"><i class="fa fa-trash-alt"></i></a>
                                                                                    </h3>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    @empty
                                                                    @endforelse
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12">
                                                    <div class="widget widget-categories">
                                                        <h2 class="title-widget">سبد خرید</h2>
                                                        <ul>
                                                            <li>
                                                                <div class="text"><a>تعداد سفارش</a></div>
                                                                <div class="number">{{ $cartItems->count() }}</div>
                                                            </li>
                                                            <li>
                                                                <div class="text"><a>مبلغ کل</a></div>
                                                                <div class="number">{{ priceFormat($cartItems->pluck('price')->sum()) }}</div>
                                                            </li>
                                                            <li>
                                                                <div class="text"><a>مبلغ قابل پرداخت</a></div>
                                                                <div class="number">{{ priceFormat($cartItems->pluck('price')->sum()) }}</div>
                                                            </li>
                                                        </ul>

                                                        @if(auth()->user()->cartItems->isNotEmpty())
                                                            <x-home.alert type="warning" class="mt-5">
                                                                <x-slot:message>هزینه این سفارش هنوز پرداخت نشده‌ و در صورت اتمام موجودی، کالاها از سبد حذف می‌شوند</x-slot:message>
                                                            </x-home.alert>
                                                        @else
                                                            <x-home.alert type="warning" class="mt-5">
                                                                <x-slot:message>سبد خرید شما خالی است.</x-slot:message>
                                                            </x-home.alert>
                                                        @endif
                                                    </div>
                                                    @if(auth()->user()->cartItems->isNotEmpty())
                                                        <x-home.button
                                                                class="text-white bg-danger w-100"
                                                                wire:navigate.hover href="{{ route('shop.cart.address-and-delivery') }}"
                                                                title="تکمیل فرآیند"
                                                        />
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
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