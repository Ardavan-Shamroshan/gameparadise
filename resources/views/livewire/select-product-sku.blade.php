<div class="meta mb-20 flex flex-column">
    <div data-wow-delay="0s" class="wow fadeInRight product-item time-sales w-100">
        <h6 class="gap4"><i class="icon-clock"></i>{{ $product->name ?? '-' }}</h6>
        <div class="content">
            <div class="text">قیمت</div>

            @guest
                <div class="flex justify-between gap30">
                    @if($product->sku?->in_stock == 0 || $product->sku?->marketable == 0)
                        <label @class(["meta-item view text-bid"])>
                            <span>ناموجود</span>
                            <input type="radio">
                        </label>
                    @else
                        @if(is_null($product->sku?->price_with_discount))
                            <p>{{ priceFormat($product->sku?->price) }}</p>
                        @else
                            <div>
                                <h3 class="disable">{{ priceFormat($product->sku?->price) }}</h3>
                                <div class="font-weight-normal h4 text-warning"><i class="fa-percent far"></i>{{ (round(100 - (100 * $product->sku?->price_with_discount / $product->sku?->price))) }}</div>
                            </div>
                            <h3>{{ priceFormat($product->sku?->price_with_discount) }}</h3>
                        @endif
                    @endif
                </div>

            @endguest

            @auth
                <form method="POST" action="{{ route('shop.cart.product-add', $product) }}" class="meta mb-20 flex-column">
                    @csrf
                    <div class="flex justify-between gap30">

                        @if($product->sku?->in_stock == 0 || $product->sku?->marketable == 0)
                            <label @class(["meta-item view text-bid"])>
                                <span>ناموجود</span>
                                <input type="radio">
                            </label>
                        @else
                            @if(is_null($product->sku?->price_with_discount))
                                <p>{{ priceFormat($product->sku?->price) }}</p>
                            @else
                                <div>
                                    <h3 class="disable">{{ priceFormat($product->sku?->price) }}</h3>
                                    <div class="font-weight-normal h4 text-warning"><i class="fa-percent far"></i>{{ (round(100 - (100 * $product->sku?->price_with_discount / $product->sku?->price))) }}</div>
                                </div>
                                <h3>{{ priceFormat($product->sku?->price_with_discount) }}</h3>
                            @endif
                            @if(auth()->user()->cartItems()->pluck('sku_id')->contains($product->sku->id))
                                <a wire:navigate.hover href="{{ route('shop.cart') }}" class="tf-button style-2 h50 w216" wire:loading.class="disabled disabled-button">مشاهده سبد خرید</a>
                            @else
                                <button type="submit" class="tf-button style-1 h50 w216 blue-btn" wire:loading.class="disabled disabled-button">افزودن به سبد خرید<i class="fa fa-cart-plus"></i></button>
                            @endif
                        @endif
                    </div>
                </form>
            @endauth
        </div>
    </div>

    @guest
        <x-home.alert type="error">
            <x-slot:message>
                برای خرید محصول بازی لطفا وارد حساب کاربری خود شوید. <a wire:navigate.hover href="{{ route('auth.authentication-form') }}" class="text-danger">ورود | ثبت نام</a>
            </x-slot:message>
        </x-home.alert>
    @endguest
</div>
