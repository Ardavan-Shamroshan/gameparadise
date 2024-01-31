<x-home.layout>


    <x-home.breadcrumb>
        <x-slot:breadcrumbs>
            <li class="icon-keyboard_arrow_left"><a href="{{ route('home') }}" class="ml-3"> خانه </a></li>
            <li class="icon-keyboard_arrow_left"><a href="{{ route('home') }}" class="ml-3"> ثبت سفارش </a></li>
            <li class="icon-keyboard_arrow_left"><a href="{{ route('shop.cart') }}" class="ml-3"> سبد خرید </a></li>
            <li dir="rtl" class="icon-1"><a> زمان و نحوه ارسال </a></li>
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
                                    <h2 class="tf-title pb-30">زمان و نحوه ارسال</h2>
                                </div>
                                <div class="widget-tabs relative">
                                    <ul class="widget-menu-tab">
                                        <li class="item-title">
                                            <a href="{{ route('shop.cart') }}" class="inner"><i class="icon-keyboard_arrow_left"></i><span class="order bg-success"><i class="fa fa-check mr-3"></i></span> سبد خرید </a>
                                        </li>
                                        <li class="item-title active">
                                            <span class="inner"><i class="icon-keyboard_arrow_left"></i><span class="order">2</span> زمان و نحوه ارسال </span>
                                        </li>
                                        <li class="item-title">
                                            <span class="inner"><i class="icon-keyboard_arrow_left"></i><span class="order">3</span> پرداخت </span>
                                        </li>
                                    </ul>

                                    <div class="tf-section-5 tf-list-blog">
                                        <div class="themesflat-container">

                                            <div class="col-12">
                                                <x-home.flash-message/>
                                            </div>

                                            <form method="POST" action="{{ route('shop.cart.address-and-delivery.store', $totalPrice) }}">
                                                @csrf

                                                <div class="row">
                                                    <livewire:address-and-delivery :$addresses :$provinces/>

                                                    <div class="side-bar col-md-4 col-12">
                                                        <div class="widget widget-categories">
                                                            <h2 class="title-widget">سبد خرید</h2>
                                                            <ul>
                                                                <li>
                                                                    <div class="text"><a href="#">تعداد سفارش</a></div>
                                                                    <div class="number">{{ $cartItems->count() }}</div>
                                                                </li>
                                                                <li>
                                                                    <div class="text"><a href="#">هزینه ارسال</a></div>
                                                                    <div class="number">{{ priceFormat(0) }}</div>
                                                                </li>
                                                                <li>
                                                                    <div class="text"><a href="#">سود شما از خرید</a></div>
                                                                    <div class="number">{{ priceFormat(0) }}</div>
                                                                </li>
                                                                <li>
                                                                    <div class="text"><a href="#">مبلغ کل</a></div>
                                                                    <div class="number">{{ priceFormat($totalPrice) }}</div>
                                                                </li>
                                                                <li>
                                                                    <div class="text"><a href="#">مبلغ قابل پرداخت</a></div>
                                                                    <div class="number">{{ priceFormat($totalPrice) }}</div>
                                                                </li>
                                                                <li>
                                                                    <div class="text"><a href="#">من از <a href="{{ route('pages', 'terms-and-conditions') }}" class="text-primary">قوانین و مقررات</a> مطلع هستم</a></div>
                                                                    <div class="number"><input name="terms_and_conditions" id="terms_and_conditions" class="check" type="checkbox"></div>
                                                                </li>

                                                                <li>
                                                                    @forelse($gateways as $gateway)
                                                                        <div class="d-flex gap4 align-items-baseline">
                                                                            @if($gateway->image)
                                                                                <div class="bg-faded rounded-85 thumbnail">
                                                                                    <img class="h-100 px-1" src="{{ asset('storage/' . $gateway->image) }}" alt="{{ $gateway->driver }}">
                                                                                </div>
                                                                            @endif
                                                                            <div class="text">{{ __(ucfirst($gateway->driver)) }}</div>
                                                                            <div class="number"><input name="gateway_id" id="gateway_id" class="radio" type="radio" value="{{ $gateway->id }}" @checked($loop->first)></div>
                                                                        </div>
                                                                    @empty
                                                                    @endforelse
                                                                </li>
                                                            </ul>

                                                            <x-home.alert type="warning" class="mt-5">
                                                                <x-slot:message>هزینه این سفارش هنوز پرداخت نشده‌ و در صورت اتمام موجودی، کالاها از سبد حذف می‌شوند</x-slot:message>
                                                            </x-home.alert>
                                                        </div>
                                                        @if(auth()->user()->cartItems->isNotEmpty())
                                                            <div class="btn-submit">
                                                                <button type="submit" class="tf-button style-1 h50 text-white bg-danger w-100">تکمیل فرآیند</button>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </form>
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