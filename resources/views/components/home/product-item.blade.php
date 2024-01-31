@props([
    'content',
    'icon',
    'title'
])

<div data-wow-delay="0s" {{ $attributes->class(['wow fadeInRight product-item']) }}>
    <h2 class="gap4 mr-20"><i class="{{ $icon }}"></i> {{ $title }} </h2>
    <i class="icon-keyboard_arrow_down"></i>
    {{ $content }}
</div>