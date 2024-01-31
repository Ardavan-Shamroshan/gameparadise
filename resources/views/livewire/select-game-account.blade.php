<div>
    @isset($accountSkus)
        <div class="flex flex-row mb-4 gap30">
            <label @class(["meta-item platform-btn view cursor-pointer radio-platform-checked","radio-checked-2 blue-shadow" => strtoupper($selectedPlatform) == 'PS5'])>
                <span><img src="{{ asset('assets/images/img14.png') }}" alt="PS5"></span>
                <input wire:model.live="selectedPlatform" name="platform" id="platform-ps5" type="radio" value="PS5">
            </label>
            <label @class(["meta-item platform-btn view cursor-pointer radio-platform-checked","radio-checked-2 blue-shadow" => strtoupper($selectedPlatform) == 'PS4'])>
                <span><img src="{{ asset('assets/images/img15.png') }}" alt="PS4"></span>
                <input wire:model.live=selectedPlatform name="platform" id="platform-ps4" type="radio" value="PS4">
            </label>
        </div>
    @endisset

    @if($selectedPlatform)
        <div class="meta flex-column mb-4">
            @isset($accountSkus)
                @forelse($accountSkus as $accountSku)
                    @php($unavailable = $accountSku->in_stock == 0 || $accountSku->marketable == 0)

                    @if($unavailable)
                        @if(DragonCode\Support\Facades\Helpers\Str::contains(strtoupper($accountSku->volume->type), $selectedPlatform))
                            <label data-wow-delay="0.1s" class="wow fadeInUp animated cursor-pointer w-100 mb-0 ">
                                <div class="gap30 style-2 flex-nowrap align-items-baseline tf-author-box relative type-1 disable border-gray" style="text-decoration: none">
                                    <div class="align-items-baseline flex gap30 w-75">
                                        <div class="author-infor">
                                            <span class="font-weight-normal h4">{{ $accountSku->volume->type ?? '' }}</span>
                                        </div>
                                        <div class="font-weight-normal h4">{{ priceFormat($accountSku->price) }}</div>
                                    </div>
                                    <p class="absolute w-25 cursor-pointer rounded-left-20 text-gray-dark tf-button disabled-button" style="
    top: 0px;
    left: 0px;
    width: 100px;
    height: 100%;
">ناموجود</p>
                                </div>
                            </label>
                        @endif
                    @else
                        @if(DragonCode\Support\Facades\Helpers\Str::contains(strtoupper($accountSku->volume->type), $selectedPlatform))
                            <form method="POST" action="{{ route('shop.cart.add', $game) }}">
                                @csrf
                                <label wire:key="select-account-sku-{{ $accountSku->id }}" for="account-sku-{{ $accountSku->id  }}" data-wow-delay="0.1s" class="wow fadeInUp animated cursor-pointer w-100 mb-0">
                                    <div @class(["select-account-sku gap30 style-2 flex-nowrap align-items-baseline tf-author-box relative type-1 border-gray", "radio-checked blue-shadow border-gray-light" => $selectedAccountSku?->volume->id == $accountSku?->volume->id])>
                                        <div class="align-items-baseline flex gap30 w-75">
                                            <div class="author-infor">
                                                <span class="font-weight-normal h4">{{ $accountSku->volume->type ?? '' }}</span>
                                            </div>

                                            @if(is_null($accountSku->price_with_discount))
                                                <div class="font-weight-normal h4">{{ priceFormat($accountSku->price) }}</div>
                                            @else
                                                <div>
                                                    <div class="font-weight-normal h4 disable">{{ priceFormat($accountSku->price) }}</div>
                                                    <div class="font-weight-normal h4 text-warning"><i class="fa-percent far"></i>{{ (round(100 -( 100 * $accountSku->price_with_discount / $accountSku->price))) }}</div>
                                                </div>
                                                <div class="font-weight-normal h4">{{ priceFormat($accountSku->price_with_discount) }}</div>
                                            @endif

                                        </div>
                                        <input type="hidden" name="account-sku" value="{{ $accountSku->id }}">
                                        <button type="submit" class="absolute w-25 blue-btn cursor-pointer rounded-left-20 text-gray-dark tf-button" style="
    top: 0px;
    left: 0px;
    width: 100px;
    height: 100%;
"><i class="fa fa-cart-plus"></i></button>
                                    </div>

                                    @if($selectedAccountSkuId == $accountSku->id)
                                        <div class="animated fadeIn wow" style="visibility: visible; animation-name: fadeIn;">
                                            <div class="text font-weight-normal">
                                                <span>ارسال از 10 دقیقه تا 48 ساعت</span>
                                                <div class="text-warning">
                                                    <i class="fa fa-exclamation-circle"></i> توجه کنید این ظرفیت را فقط برروی کنسول {{ $selectedPlatform ?? '' }} اجرا کنید.
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <input wire:model.live="selectedAccountSkuId" name="account-sku" id="account-sku-{{ $accountSku->id }}" type="radio" value="{{ $accountSku->id }}">
                                </label>
                            </form>
                        @endif
                    @endif
                @empty
                @endforelse
            @endisset
        </div>
    @else
        @isset($accountSkus)
            <x-home.alert type="warning" class="orange-shadow">
                <x-slot:message>
                    گیمر عزیز ابتدا برای خرید اکانت بازی حتما کنسول مورد نظر خودتون رو انتخاب کنید.
                </x-slot:message>
            </x-home.alert>
        @endisset
    @endif


    <x-home.alert type="info" class="blue-shadow">
        <x-slot:message>
            گیمر عزیز به این نکته توجه کن! هنگام خرید اکانت به کنسول آن هم دقت کنید. هر اکانت باید فقط روی همون کنسول مخصوص خودش اجرا بشه.
        </x-slot:message>
    </x-home.alert>
</div>