<x-home.layout>


    <x-home.breadcrumb>
        <x-slot:breadcrumbs>
            <li class="icon-keyboard_arrow_left"><a wire:navigate.hover href="{{ route('home') }}"> خانه </a></li>
            <li dir="rtl" class="icon-1"><a wire:navigate.hover> {{ $collection?->name ?? '' }} </a></li>
        </x-slot:breadcrumbs>
    </x-home.breadcrumb>

    <div class="tf-section-3 discover-item ">
        <div class="themesflat-container">
            <div class="row" dir="rtl">
                <div class="col-md-12">
                    <div class="heading-section pb-30">
                        <h1 class="h1">{{ $collection?->name ?? '' }}</h1>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="widget-category-checkbox style-1 mb-30">
                        <h5>دسته بندی ها</h5>
                        <div class="content-wg-category-checkbox">
                            {{--                            <form action="#">--}}
                            {{--                                <label>--}}
                            {{--                                    <span class="mr-30">Buy now</span>--}}
                            {{--                                    <input type="checkbox">--}}
                            {{--                                    <span class="btn-checkbox"></span>--}}
                            {{--                                </label><br>--}}
                            {{--                            </form>--}}
                            @forelse($sidebarCategories as $category)
                                <label>
                                    <a href="{{ route('category.show', $category) }}" @class(["text-primary" => str_contains(request()->url(), $category->slug)])>{{ $category->name ?? '-' }}</a>
                                </label><br>
                            @empty
                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="row">
                        {{-- games collection --}}
                        @if($collection?->games?->isNotEmpty())
                            @php($games = $collection?->games()->paginate(32))

                            <x-home.taxonomy-card :collection="$games" title="بازی ها" :collection-name="$collection?->name" :href="route('game-net.games')">
                                @forelse($games as $game)
                                    <div data-wow-delay="0s" wire:ignore wire:key="game-card-{{ $game->id }}" class="wow fadeInUp col-xl-3 col-lg-4 col-md-6 col-sm-6 w-50 px-2" dir="rtl">
                                        <x-home.game-card :model="$game" :$loop/>
                                    </div>
                                @empty
                                @endforelse
                            </x-home.taxonomy-card>
                        @endif

                        {{-- products collection --}}
                        @if($collection?->products?->isNotEmpty())
                            @php($products = $collection?->products()->paginate(32))

                            <x-home.taxonomy-card :collection="$products" title="محصولات" :collection-name="$collection?->name" :href="route('shop.products')">
                                @forelse($products as $product)
                                    <div data-wow-delay="0s" wire:ignore wire:key="product-card-{{ $product->id }}" class="wow fadeInUp col-xl-4 col-lg-3 col-md-6 col-sm-6 w-50" dir="rtl">
                                        <x-home.product-card :model="$product" :$loop/>
                                    </div>
                                @empty
                                @endforelse
                            </x-home.taxonomy-card>
                        @endif

                        {{-- posts collection --}}
                        @if($collection?->posts?->isNotEmpty())
                            @php($posts = $collection?->posts()->paginate(32))

                            <x-home.taxonomy-card :collection="$posts" title="نوشته ها" :collection-name="$collection?->name" :href="route('content.posts')">
                                @forelse($posts as $post)
                                    <div data-wow-delay="0s" wire:ignore wire:key="post-card-{{ $post->id }}" class="wow fadeInUp col-xl-3 col-lg-4 col-md-6 col-sm-6 w-50 px-2" dir="rtl">
                                        <x-home.post-card :$post :$loop/>
                                    </div>
                                @empty
                                @endforelse
                            </x-home.taxonomy-card>
                        @endif
                    </div>
                </div>

                @if($collection->description)
                    <div class="tf-section tf-blog-detail py-5 col-md-12">
                        <div class="themesflat-container">
                            <div class="row">
                                <div class="wrapper col-md-12" dir="rtl">
                                    <div class="inner-content mr-20">
                                        <div class="inner-post text">
                                            {!! $collection->description !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <x-home.footer/>

</x-home.layout>


