@props([
    'title' => '',
    'icon' => ''
])

<a {{ $attributes->merge(['class' => 'tf-button style-1']) }}>
    <span>{{ $title }}</span>
    <i class="{{ $icon }}"></i>
</a>