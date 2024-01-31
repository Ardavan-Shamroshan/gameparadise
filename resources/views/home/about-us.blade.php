<x-home.layout>
    <x-slot:title>درباره ما</x-slot:title>
    <x-slot:url>https://gpgaming.ir/</x-slot:url>
    <x-slot:name>گیم پردایس</x-slot:name>



    <x-home.breadcrumb>
        <x-slot:breadcrumbs>
            <li class="icon-keyboard_arrow_left"><a wire:navigate.hover href="{{ route('home') }}"> خانه </a></li>
            <li class="icon-1"><a > درباره ما </a></li>
        </x-slot:breadcrumbs>
    </x-home.breadcrumb>

    <div class="page-title faqs" dir="rtl">
        <div class="themesflat-container">
            <div class="row">
                <div class="col-12">
                    <h1 data-wow-delay="0s" class="wow fadeInUp heading text-center">با اعتماد خرید</h1>
                    <p data-wow-delay="0.1s" class="wow fadeInUp ">به بهشت بازی ما خوش آمدید. بهترین بازی ها و کنسول های بازی روز دنیا را در اینجا کاوش کنید و از بازی کردن لذت ببرید</p>
                </div>
            </div>
        </div>
    </div>

    <div class="tf-section-2 widget-term-condition" dir="rtl">
        <div class="themesflat-container">
            <div class="row flat-tabs">
                <div class="col-md-3 col-12">
                    <div class="wrap-menu po-sticky" style="top: 0px;">
                        <div class="title">فهرست</div>
                        <ul class="menu-tab">
                            <li class="item-title active">
                                <span class="inner">1. درباره ما</span>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="col-md-9 col-12">
                    <div class="content-tab po-sticky-footer">
                        <div class="content-inner active">
                            <div class="date">آخرین ویرایش: {{ jalaliDate($setting->updated_at) }}</div>

                           <div class="text">
                               {!! $setting->about_us !!}
                           </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-home.footer/>

</x-home.layout>