@props([
    'model',
    'interval'
])

<div {{ $attributes->class(['tf-card-box style-2']) }}>
    <div class="card-media border-gray">
        <a href="{{ route('game-net.games.show', $model) }}">
            <img src="{{ ($model->image->first()->thumbnail_url) }}" alt="{{ $model->account?->name ?? $model->name ?? '' }}">
        </a>

{{--        <livewire:wishlist-button wire:model="morphedTo" wire:key="wishlist-game-net-game-{{ $model->id }}" :morphedTo="$model"/>--}}

        <div class="featured-countdown">
            @if($interval > 0)
                <span class="js-countdown" data-timer="{{ $interval }}" data-labels="d,h,m,s"></span>
            @else
                <span>{{ $model->released_at?->format('Y') }}</span>
            @endif
        </div>

        <div class="button-place-bid">
            <a href="{{ route('game-net.games.show', $model) }}" class="tf-button"><span>بازی کن</span></a>
        </div>
    </div>

    @if($model instanceof \App\Models\GameNet\Game)
        <div class="author flex items-center justify-between">
            @if($model->publisher?->logo)
                <div class="avatar">
                    <img src="{{ ($model->publisher?->logo?->first()?->thumbnail_url) }}" alt="{{ $model->publisher?->name ?? '' }}">
                </div>
            @endif
            <div class="info">
                <h3><a href="#">{{ $model->publisher?->name ?? '' }}</a></h3>
            </div>
        </div>
    @endif

</div>
