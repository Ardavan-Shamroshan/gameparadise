<x-home.layout>
    <x-slot:title>دسته ها</x-slot:title>
    <x-slot:url>https://gpgaming.ir/</x-slot:url>
    <x-slot:name>گیم پردایس</x-slot:name>


    <x-home.breadcrumb>
        <x-slot:breadcrumbs>
            <li class="icon-keyboard_arrow_left"><a wire:navigate.hover href="{{ route('home') }}"> خانه </a></li>
            <li dir="rtl" class="icon-1"><a wire:navigate.hover> {{ $taxonomy->name ?? '' }} </a></li>
        </x-slot:breadcrumbs>
    </x-home.breadcrumb>

    <div class="tf-section-3 discover-item ">
        <div class="themesflat-container">
            <div class="row">
                @if($taxonomy->games?->isNotEmpty())
                    <div class="col-md-12">
                        <div class="heading-section pb-30">
                            <a wire:navigate href="{{ route('game-net.games') }}"> جستجوی بیشتر <i class="icon-arrow-left2"></i></a>
                            <h1 dir="rtl">بازی های <span>{{ $taxonomy->name }}</span></h1>
                        </div>
                    </div>

                    @forelse($taxonomy->games as $game)
                        <div data-wow-delay="0s" wire:ignore wire:key="game-card-{{ $game->id }}" class="wow fadeInUp col-xl-3 col-lg-4 col-md-6 col-sm-6 w-50 px-2" dir="rtl">
                            <x-home.game-card :model="$game" :$loop/>
                        </div>
                    @empty @endforelse
                    <div class="col-md-12">
                        {{ $taxonomy->games()?->paginate(32)->links(data: ['scrollTo' => false]) }}
                    </div>
                @endif

                @if($taxonomy->products?->isNotEmpty())
                    <div class="col-md-12">
                        <div class="heading-section pb-30">
                            <a wire:navigate href="{{ route('shop.products') }}"> جستجوی بیشتر <i class="icon-arrow-left2"></i></a>
                            <h1 dir="rtl">محصولات <span>{{ $taxonomy->name }}</span></h1>
                        </div>
                    </div>

                    @forelse($taxonomy->products as $product)
                        <div data-wow-delay="0s" wire:ignore wire:key="product-card-{{ $product->id }}" class="wow fadeInUp col-xl-3 col-lg-4 col-md-6 col-sm-6 w-50 px-2" dir="rtl">
                            <x-home.product-card :model="$product" :$loop/>
                        </div>
                    @empty @endforelse
                    <div class="col-md-12">
                        {{ $taxonomy->products()?->paginate(32)->links(data: ['scrollTo' => false]) }}
                    </div>
                @endif

                @if($taxonomy->posts?->isNotEmpty())
                    <div class="col-md-12">
                        <div class="heading-section pb-30">
                            <a wire:navigate href="{{ route('content.posts') }}"> جستجوی بیشتر <i class="icon-arrow-left2"></i></a>
                            <h1 dir="rtl">نوشته ها <span>{{ $taxonomy->name }}</span></h1>
                        </div>
                    </div>

                    @forelse($taxonomy->posts as $post)
                        <div data-wow-delay="0s" wire:ignore wire:key="post-card-{{ $post->id }}" class="wow fadeInUp col-xl-3 col-lg-4 col-md-6 col-sm-6 w-50 px-2" dir="rtl">
                            <x-home.post-card :$post/>
                        </div>
                    @empty @endforelse
                    <div class="col-md-12">
                        {{ $taxonomy->posts()?->paginate(32)->links(data: ['scrollTo' => false]) }}
                    </div>
                @endif

            </div>
        </div>
    </div>

    <x-home.footer/>


</x-home.layout>


