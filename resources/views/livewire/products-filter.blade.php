<div class="row flex-row-reverse">
    <div class="col-md-12" dir="rtl">
        <div class="heading-section pb-30">
            <h1>محصولات</h1>
        </div>
    </div>
    <div class="col-md-12 col-sm-4 pb-30">
        <div class="tf-soft flex items-center justify-between">
            <div class="soft-left d-flex text align-items-center justify-start gap4 flex-wrap">
                <span><i class="fa fa-sort-amount-asc"></i> مرتب سازی: </span>
                <x-home.filters @class(['text-primary' => $filterByCreatedAt]) wire-click="$toggle('filterByCreatedAt')" wire-model="filterByCreatedAt" title="جدیدترین"/>
                <x-home.filters @class(['text-primary' => $filterByView]) wire-click="$toggle('filterByView')" wire-model="filterByView" title="پربازدیدترین"/>
                <x-home.filters @class(['text-primary' => $filterBySell]) wire-click="$toggle('filterBySell')" wire-model="filterBySell" title="پرفروش ترین"/>
                <x-home.filters @class(['text-primary' => $filterByPrice]) wire-click="$toggle('filterByPrice')" wire-model="filterByPrice" title="ارزانترین"/>
                <span wire:loading> <i class="fa fa-spin fa-spinner spinner spinner-icon"></i></span>
            </div>
            <div class="soft-right"></div>
        </div>
    </div>

    <div class="div col-md-12 col-sm-8">
        <div class="row">

            @forelse($products as $product)

                <div class="wow fadeInUp col-xl-3 col-lg-4 col-md-6 col-sm-6 w-50 px-2" dir="rtl" wire:ignore wire:key="product-card-filter-{{ $product->id }}">
                    <x-home.product-card :model="$product" :$loop/>
                </div>

            @empty
            @endforelse

            @if($pagination)
                <div class="col-md-12">
                    {{ $products->links(data: ['scrollTo' => false]) }}
                </div>
            @endif
        </div>
    </div>
    {{--    <x-home.button-loadmore text="بیشتر"/>--}}

</div>