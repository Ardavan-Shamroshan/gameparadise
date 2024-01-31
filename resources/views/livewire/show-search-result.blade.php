<div>
    <x-slot:title>جستجو</x-slot:title>
    <x-slot:url>https://gpgaming.ir/</x-slot:url>
    <x-slot:name>گیم پردایس</x-slot:name>


    <x-home.breadcrumb>
        <x-slot:breadcrumbs>
            <li class="icon-keyboard_arrow_left"><a wire:navigate.hover href="{{ route('home') }}"> خانه </a></li>
            <li class="icon-keyboard_arrow_left"><a wire:navigate.hover href="{{ route('home') }}"> جستجو </a></li>
            <li dir="rtl" class="icon-1"><a wire:navigate.hover> {{ request()->has('search') ? request()->search : '' }} </a></li>
        </x-slot:breadcrumbs>
    </x-home.breadcrumb>

    <div class="tf-section-2 discover-item loadmore-12-item">
        <div class="themesflat-container">
            <div class="row">
                <div class="col-12">
                    <div class="widget-tabs relative">
                        <ul class="widget-menu-tab">
                            <li class="bg-dark-transparent text-white border-gray-light item-title active">
                                <a href="#games" class="inner active"> اکانت های قانونی بازی </a>
                                <span>{{  isset($results['games']) ? count($results['games']) : ''  }} مورد </span>
                            </li>
                            <li class="bg-dark-transparent text-white border-gray-light item-title">
                                <a href="#products" class="inner"> محصولات </a>
                                <span>{{  isset($results['games']) ? count($results['products']) :'' }} مورد </span>

                            </li>
                            <li class="bg-dark-transparent text-white border-gray-light item-title">
                                <a href="#posts" class="inner"> نوشته ها </a>
                                <span>{{  isset($results['games']) ? count($results['posts']):''  }} مورد </span>

                            </li>
                        </ul>
                        <div class="widget-content-tab pt-10">
                            <div class="widget-content-inner games active">
                                <div class="row">
                                    @isset($results['games'])
                                        @forelse($results['games'] as $game)
                                            <div wire:key="search-game-card-{{ $game->id }}" class="fl-item w-50 col-xl-3 col-lg-4 col-md-6 col-sm-6" dir="rtl">
                                                <x-home.game-card :model="$game" :$loop/>
                                            </div>
                                        @empty
                                            <div class="col-12 page-title no-result py-0">
                                                <h1 data-wow-delay="0s" class="wow fadeInUp heading text-center animated" style="visibility: visible; animation-delay: 0s; animation-name: fadeInUp;">موردی یافت نشد</h1>
                                                <p data-wow-delay="0.1" dir="rtl" class="wow fadeInUp  animated" style="visibility: visible; animation-name: fadeInUp;">ببخشید، ما نتونستیم نتیجه ای برای <span>“{{ $search }}”</span>
                                                    پیدا کنیم.</p>
                                            </div>
                                        @endforelse
                                    @endisset
                                    {{--                                    <div class="col-md-12">--}}
                                    {{--                                        {{ $results['games']->links() }}--}}
                                    {{--                                    </div>--}}
                                </div>
                            </div>
                            <div class="widget-content-inner products">
                                <div class="row">
                                    @isset($results['products'])
                                        @forelse($results['products'] as $product)
                                            <div wire:key="search-product-card-{{ $product->id }}" class="w-50 col-xl-3 col-lg-4 col-md-6 col-sm-6" dir="rtl">
                                                <x-home.product-card :model="$product" :$loop/>
                                            </div>
                                        @empty
                                            <div class="col-12 page-title no-result py-0">
                                                <h1 data-wow-delay="0s" class="wow fadeInUp heading text-center animated" style="visibility: visible; animation-delay: 0s; animation-name: fadeInUp;">موردی یافت نشد</h1>
                                                <p data-wow-delay="0.1" dir="rtl" class="wow fadeInUp  animated" style="visibility: visible; animation-name: fadeInUp;">ببخشید، ما نتونستیم نتیجه ای برای <span>“{{ $search }}”</span>
                                                    پیدا کنیم.</p>
                                            </div>
                                        @endforelse
                                    @endisset
                                </div>
                            </div>
                            <div class="widget-content-inner posts">
                                <div class="row">
                                    @isset($results['posts'])
                                        @forelse($results['posts'] as $post)
                                            <div wire:key="search-post-card-{{ $post->id }}" class="wow fadeInUp w-50 col-xl-3 col-lg-4 col-md-6 col-sm-6" dir="rtl">
                                                <x-home.post-card :$post :$loop/>
                                            </div>
                                        @empty
                                            <div class="col-12 page-title no-result py-0">
                                                <h1 data-wow-delay="0s" class="wow fadeInUp heading text-center animated" style="visibility: visible; animation-delay: 0s; animation-name: fadeInUp;">موردی یافت نشد</h1>
                                                <p data-wow-delay="0.1" dir="rtl" class="wow fadeInUp  animated" style="visibility: visible; animation-name: fadeInUp;">ببخشید، ما نتونستیم نتیجه ای برای <span>“{{ $search }}”</span>
                                                    پیدا کنیم.</p>
                                            </div>
                                        @endforelse
                                    @endisset
                                </div>
                            </div>
                        </div>

                        @empty($results)
                            <div class="col-12 page-title no-result py-0" wire:loading.remove>
                                <h1 data-wow-delay="0s" class="wow fadeInUp heading text-center animated" style="visibility: visible; animation-delay: 0s; animation-name: fadeInUp;">موردی یافت نشد</h1>
                                <p data-wow-delay="0.1" dir="rtl" class="wow fadeInUp  animated" style="visibility: visible; animation-name: fadeInUp;">ببخشید، ما نتونستیم نتیجه ای برای <span>“{{ $search }}”</span>
                                    پیدا کنیم.</p>
                            </div>
                            <div class="col-12 page-title no-result py-0" wire:loading>
                                <i class="fa fa-spin fa-spinner spinner spinner-icon"></i>
                            </div>
                        @endempty
                    </div>
                </div>

            </div>
        </div>
    </div>

    <x-home.footer/>


</div>


