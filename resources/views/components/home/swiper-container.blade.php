@props([
    'underTopSlideshow',
    'dataSwiper'    => [],
    'wrapperClass'  => ''
])

<div {{ $attributes->class(['swiper-container']) }} data-swiper="{{ json_encode($dataSwiper) }}">
    <div class="swiper-wrapper justify-center {{ $wrapperClass }}">
        {{ $slot }}
    </div>
</div>