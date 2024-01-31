@props([
    'model'
])

@php($firstSku = $model?->sku()?->first())

<div class='tf-card-box style-1' :class="{ 'bg-white' : Light }">
    <div class="card-media border-gray">
        <a wire:navigate.hover href="{{ route('shop.products.show', $model) }}">
            @empty($model->getMedia('product')->first())
                <img src="{{ asset($model->cover?->first()->thumbnail_url ?? $model->image?->first()->thumbnail_url) }}" alt="{{ $model->name }}">
            @else
                @if($model->getMedia('product')->first()->hasGeneratedConversion('thumb'))
                    <img src="{{ asset($model->getMedia('product')->first()?->getUrl('thumb')) }}" alt="{{ $model->name }}">
                @endif
            @endempty
        </a>

        @if($firstSku)
            <span class="wishlist-button w-25">{{ __(ucfirst($firstSku->status)) }}</span>
        @endif

        <div class="button-place-bid">
            <a wire:navigate.hover href="{{ route('shop.products.show', $model) }}" class="tf-button orange-btn"><span>میخرمش</span></a>
        </div>
    </div>
    <h2 class="name text-truncate"><a wire:navigate.hover href="{{ route('shop.products.show', $model) }}">{{ \Illuminate\Support\Str::limit($model->name ?? '', 25) }}</a></h2>

    <div class="divider"></div>
    <div class="meta-info flex items-center justify-between">
        @if($model->sku?->inStockCheck())
            <span class="tf-btn border-gray text-bid">ناموجود</span>
        @else
            @if(is_null($firstSku->price_with_discount))
                <h2 class="green-btn tf-btn">{{ priceFormat($firstSku->price) }}</h2>
            @else
                <div>
{{--                    <h3 class="disable">{{ priceFormat($firstSku->price) }}</h3>--}}
                    <h3 class="price text-warning"><i class="fa-percent far"></i>{{ (round(100-(100 * $firstSku->price_with_discount / $firstSku->price))) }}</h3>
                </div>
                <h2 class="orange-btn tf-btn">{{ priceFormat($firstSku->price_with_discount) }}</h2>
            @endif
        @endif
    </div>
</div>
