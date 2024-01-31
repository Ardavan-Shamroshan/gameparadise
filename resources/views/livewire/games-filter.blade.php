<div class="row">
    <div class="col-md-12" dir="rtl">
        <div class="heading-section pt-25 pb-3">
            <h1>جدیدترین بازی ها</h1>
        </div>

        <div class="col-md-12 col-sm-4 pb-30" x-data="{ openFilter: false , toggle() { this.openFilter = !this.openFilter} }">
            <div class="tf-soft d-flex flex-column">
                <div class="text">
                    <span><i class="fa fa-sort-amount-asc"></i> مرتب سازی: </span>
                </div>
                <div class="align-items-center d-flex gap4 soft-right" x-show="openFilter">
                    <x-home.filters wire-click="$toggle('createdAt')" wire-model="createdAt" title="جدیدترین"/>
                    <x-home.filters wire-click="$toggle('releasedAt')" wire-model="releasedAt" title="زمان انتشار"/>
                </div>
            </div>
        </div>

    </div>
    @forelse($games as $game)
        <div data-wow-delay="0s" wire:ignore wire:key="game-card-{{ $game->id }}" class="wow fadeInUp col-xl-3 col-lg-4 col-md-6 col-sm-6 w-50 px-3" dir="rtl">
            <x-home.game-card :model="$game" :$loop/>
        </div>
    @empty
    @endforelse
    @if($pagination)
        <div class="col-md-12">
            {{ $games->links(data: ['scrollTo' => false]) }}
        </div>
    @endif
</div>