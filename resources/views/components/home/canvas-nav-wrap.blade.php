<div class="canvas-nav-wrap">
    <div class="overlay-canvas-nav"></div>
    <div class="inner-canvas-nav" dir="ltr">
        <div class="side-bar">
            <a wire:navigate.hover href="{{ route('home') }}" rel="home" class="main-logo">
                <img id="logo_header"
                     class="logo-circle"
                     src="{{ asset('assets/images/logo/asli.png') }}" data-retina="assets/images/logo/logo@2x.png">
            </a>
            <div class="canvas-nav-close">
                <svg xmlns="http://www.w3.org/2000/svg" fill="white" x="0px" y="0px" width="20px" height="20px" viewBox="0 0 122.878 122.88" enable-background="new 0 0 122.878 122.88" xml:space="preserve"><g>
                        <path d="M1.426,8.313c-1.901-1.901-1.901-4.984,0-6.886c1.901-1.902,4.984-1.902,6.886,0l53.127,53.127l53.127-53.127 c1.901-1.902,4.984-1.902,6.887,0c1.901,1.901,1.901,4.985,0,6.886L68.324,61.439l53.128,53.128c1.901,1.901,1.901,4.984,0,6.886 c-1.902,1.902-4.985,1.902-6.887,0L61.438,68.326L8.312,121.453c-1.901,1.902-4.984,1.902-6.886,0 c-1.901-1.901-1.901-4.984,0-6.886l53.127-53.128L1.426,8.313L1.426,8.313z"/>
                    </g></svg>
            </div>

            <x-home.widget-checkbox-canvas :collection="$productCategories" title="دسته بندی محصولات" wire-model="selectedCategories"/>
            <x-home.widget-checkbox-canvas :collection="$postCategories" title="دسته بندی نوشته ها" wire-model="selectedPostCategories"/>
{{--            <x-home.widget-checkbox-canvas :collection="$genres" title="ژانر بازی ها" wire-model="selectedGenres"/>--}}

            <div class="widget">
                <h2 class="title-widget" dir="rtl">همراه ما باشید</h2>
                <x-home.widget-social/>
            </div>
        </div>
    </div>
</div>
