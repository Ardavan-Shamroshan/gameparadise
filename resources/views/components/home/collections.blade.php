<div class="swiper-slide">
    <div class="tf-card-collection" :class="{ 'bg-white' : Light }">
        <a href="{{ route('taxonomy', ['typeof' => 'publisher', 'id' => $model]) }}">
            <div class="media-images-collection" style="grid-template-columns: repeat(2, 1fr); !important;">
                @if($model->games)
                    @forelse($model->games()->latest()->take(4)->get() as $game)
                            <img src="{{ ($game->getMedia('game')->first()?->getUrl('thumb') ?? $game->cover?->first()->thumbnail_url ?? $game->image?->first()->thumbnail_url)  }}" alt="{{ $game->account?->name ?? $game->name ?? '' }}" style="height: 167px !important;">@empty
                    @endforelse
                @endif

                @if($model->logo)
                    <div class="author-poster border-gray">
                        <img src="{{ ($model->logo->first()?->thumbnail_url) }}" alt="{{ $model->name ?? '' }}" class="w-full">
                    </div>
                @endif

            </div>
        </a>
        <div class="card-bottom">
            <div class="author">
                <h2><a href="{{ route('taxonomy', ['typeof' => 'publisher', 'id' => $model]) }}">{{ $model->name ?? '' }}</a></h2>
            </div>
            <div class="bottom-right">
                <div class="shop">
                    <div class="icon border-gray">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16.875 6.25L16.3542 15.11C16.3261 15.5875 16.1166 16.0363 15.7685 16.3644C15.4204 16.6925 14.96 16.8752 14.4817 16.875H5.51833C5.03997 16.8752 4.57962 16.6925 4.23152 16.3644C3.88342 16.0363 3.6739 15.5875 3.64583 15.11L3.125 6.25M8.33333 9.375H11.6667M2.8125 6.25H17.1875C17.705 6.25 18.125 5.83 18.125 5.3125V4.0625C18.125 3.545 17.705 3.125 17.1875 3.125H2.8125C2.295 3.125 1.875 3.545 1.875 4.0625V5.3125C1.875 5.83 2.295 6.25 2.8125 6.25Z"
                                  stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </div>
                    @if($model->games)
                        <p>{{ $model->games->count() }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>