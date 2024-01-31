<div class="widget-search side-bar" x-data="{ searchInput:'', clearSearch() {this.searchInput = ''; $wire.search = '';$wire.results = [];$dispatch('clear-search')} }">
    <form wire:submit.prevent="submit(Object.fromEntries(new FormData($event.target)))" method="GET" class="search-form relative">
        <button class="search search-submit" type="submit" title="Search">
            <i class="icon-search" wire:loading.remove wire:loading.class="text-muted"></i>
            <i class="fa fa-spin fa-spinner spinner spinner-icon" wire:loading></i>
        </button>
        <input wire:model.live.debounce.250ms="search" type="text" id="search" class="search-field style-1 border-gray" placeholder="جستجو..." name="search" x-model="searchInput">

        <!-- result -->
        @if(count($results) > 0)
            <div class="wow fadeInDown w-100 absolute widget widget-categories scrollbar my-2 border-gray" style="max-height: 35rem; overflow: auto; z-index:100">
                <button type="button" class="bg-dark-transparent border-gray px-0 py-0 text-center text-white tf-button" @click="clearSearch()">پاک کردن</button>

                @forelse($results as $key => $result)
                    @if($key == 'posts' && count($results['posts']) > 0)
                        <h1 class="border-gray text-center tf-btn tf-btn-fill">نوشته ها</h1>
                        <ul>
                            @forelse($results['posts'] as $post)
                                <li dir="rtl" class="text align-items-baseline d-flex flex-wrap flex-row gap4 justify-content-start text-right">
                                    <div><img class="rounded-85 thumbnail border-gray" src="{{ ($post->image?->first()?->thumbnail_url) }}" alt="{{ $post->title ?? '' }}"></div>
                                    <a wire:navigate.hover href="{{ route('content.posts.show', $post['slug']) }}">{{ \Illuminate\Support\Str::limit($post->title ?? '', 50) }}</a>
                                </li>
                            @empty
                            @endforelse
                        </ul>
                    @endif
                    @if($key == 'games' && count($results['games']) > 0)
                        <h1 class="border-gray fo text-center tf-btn tf-btn-fill">بازی ها</h1>
                        <ul>
                            @forelse($results['games'] as $game)
                                <li dir="rtl" class="text align-items-baseline d-flex flex-wrap flex-row gap4 justify-content-start text-right">
                                    <div><img class="rounded-85 thumbnail border-gray" src="{{ ($game->getMedia('game')->first()?->getUrl('thumb') ?? $game->cover?->first()->thumbnail_url ?? $game->image?->first()->thumbnail_url) }}" alt="{{ $game->name ?? '' }}"></div>
                                    <a wire:navigate.hover href="{{ route('game-net.games.show', $game['slug']) }}">{{ \Illuminate\Support\Str::limit($game->account->name ?? '', 50) }}</a>
                                </li>
                            @empty
                            @endforelse
                        </ul>
                    @endif
                    @if($key == 'products' && count($results['products']) > 0)
                        <h1 class="border-gray fo text-center tf-btn tf-btn-fill">محصولات</h1>
                        <ul>
                            @forelse($results['products'] as $product)
                                <li dir="rtl" class="text align-items-baseline d-flex flex-wrap flex-row gap4 justify-content-start text-right">
                                    <div><img class="rounded-85 thumbnail border-gray" src="{{ ($product->cover?->first()->thumbnail_url ?? $product->image?->first()?->thumbnail_url) }}" alt="{{ $product->name ?? '' }}"></div>
                                    <a wire:navigate.hover href="{{ route('shop.products.show', $product['slug']) }}">{{ \Illuminate\Support\Str::limit($product->name ?? '', 50) }}</a>
                                </li>
                            @empty
                            @endforelse
                        </ul>
                    @endif
                @empty
                @endforelse
            </div>
        @endif
    </form>
</div>