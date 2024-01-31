@props([
    'model',
    'loop'
])

@php
    $firstAccountSku = $model?->account?->accountSkus()?->orderByDesc('price_with_discount')->orderBy('price')->first()
@endphp

<div class='tf-card-box style-1' wire:key="game-card-detail-{{ $loop->iteration }}" :class="{ 'bg-white' : Light }">
    <div class="card-media border-gray">
        <a href="{{ route('game-net.games.show', $model) }}">
            @empty($model->getMedia('game')->first())
                <img src="{{ asset($model->cover?->first()->thumbnail_url ?? $model->image?->first()->thumbnail_url) }}" alt="{{ $model->name }}" style="height: auto !important;">
            @else
                @if($model->getMedia('game')->first()->hasGeneratedConversion('thumb'))
                    <img src="{{ asset($model->getMedia('game')->first()?->getUrl('thumb')) }}" alt="{{ $model->name }}" style="height: auto !important;">
                @endif
            @endempty
        </a>

        @if($firstAccountSku)
            <span class="wishlist-button w-25">{{ __(ucfirst($firstAccountSku->status)) }}</span>
        @endif

        <div class="button-place-bid">
            <a href="{{ route('game-net.games.show', $model) }}" class="tf-button blue-btn"><span>بازی کن</span></a>
        </div>
    </div>

    @php
        $name = null;
        if($model->account)
            $name = str_replace('اکانت قانونی', '', $model->account->name);
    @endphp

    <h2 class="name text-truncate">
        <a href="{{ route('game-net.games.show', $model) }}" class="small">
            <span>اکانت قانونی</span>
            <br>
            <span>{{ \Illuminate\Support\Str::limit( $name ?? $model->name ?? '', 40) }}</span>
        </a>
    </h2>
    <div class="divider"></div>
    <div class="flex flex-wrap gap4 items-center justify-between meta-info">
        @if($firstAccountSku)
            @if(is_null($firstAccountSku->price_with_discount))
                <h2 class="green-btn tf-btn">{{ priceFormat($firstAccountSku->price) }}</h2>
            @else
                <div>
{{--                    <h3 class="disable">{{ priceFormat($firstAccountSku->price) }}</h3>--}}
                    <h3 class="price text-warning"><i class="fa-percent far"></i>{{ (round (100-(100 * $firstAccountSku->price_with_discount / $firstAccountSku->price))) }}</h3>

                </div>
                <h2 class="orange-btn tf-btn">{{ priceFormat($firstAccountSku->price_with_discount) }}</h2>
            @endif
        @else
            <span class="tf-btn border-gray text-bid">ناموجود</span>
        @endif
    </div>
</div>
