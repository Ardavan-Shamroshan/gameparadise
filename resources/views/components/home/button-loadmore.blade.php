<div {{ $attributes->class(['col-md-12 load-more wow fadeIn']) }}>
    <a wire:click="loadMore" class="tf-button-loadmore">
        <span wire:loading.remove>{{ $text ?? '' }}</span>
        <i class="icon-loading-1" wire:loading></i>
    </a>
</div>