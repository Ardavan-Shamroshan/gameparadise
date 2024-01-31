<div class="popup-notification relative">
    <div class="notification orange-btn">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-50">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z"/>
            @if($cartItems->isNotEmpty())
                <circle cx="17" cy="5" r="4" fill="#DDF247" stroke="#1D1D1D" stroke-width="1.5"></circle>
            @endif
        </svg>
    </div>
    <div class="avatar_popup" dir="rtl">
        <h2 class="mb-30">سبد خرید</h2>
        <div class="widget-recently">
            <div class="card-small">
                <div class="author flex-wrap items-center">
                    @isset($cartItems)
                        @forelse($cartItems as $cartItem)
                            @if($cartItem->game)
                                <div class="flex items-center mb-4">
                                    <img src="{{ ($cartItem->game->getMedia('game')->first()?->getUrl('thumb') ?? $cartItem->game->cover?->first()->thumbnail_url ?? $cartItem->game->image->first()->thumbnail_url) }}" alt="{{ $cartItem->game->name ?? '' }}" class="ml-4 w-25">
                                    <div class="info">
                                        <h3><a wire:navigate.hover href="{{ route('game-net.games.show', $cartItem->game) }}">{{ $cartItem->accountSku?->volume?->type ?? '' }}</a></h3>
                                        <p><a wire:navigate.hover href="{{ route('game-net.games.show', $cartItem->game) }}">{{ $cartItem->game->name ?? '' }}</a></p>
                                    </div>
                                    <span class="date text-danger mr-10 cursor-pointer" wire:click="removeFromCart({{ $cartItem->id }})"><i class="fa fa-trash-alt"></i></span>
                                </div>
                            @endif
                            @if($cartItem->product)
                                <div class="flex items-center mb-4">
                                    <img src="{{ ($cartItem->product->getMedia('product')->first()?->getUrl('thumb') ?? $cartItem->product->cover?->first()->thumbnail_url ?? $cartItem->product->image->first()->thumbnail_url) }}" alt="{{ $cartItem->product->name ?? '' }}" class="ml-4 w-25">
                                    <div class="info">
                                        <h3><a wire:navigate.hover href="{{ route('shop.products.show', $cartItem->product) }}">{{ $cartItem->product->name ?? '' }}</a></h3>
                                        <p><a wire:navigate.hover href="{{ route('shop.products.show', $cartItem->product) }}">{{ $cartItem->sku->code ?? '' }}</a></p>
                                    </div>
                                    <span class="date text-danger mr-10 cursor-pointer" wire:click="removeFromCart({{ $cartItem->id }})"><i class="fa fa-trash-alt"></i></span>
                                </div>
                            @endif

                        @empty
                            <span class="date text-bid">سبد خرید شما خالی است</span>
                        @endforelse

                        <x-home.button
                                class="mt-16 w-100 blue-btn"
                                wire:navigate.hover href="{{ route('shop.cart') }}"
                                title="ثبت سفارش"
                        />
                    @endisset
                </div>
            </div>
        </div>
    </div>
</div>
