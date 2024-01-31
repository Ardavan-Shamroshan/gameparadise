@props([
    'src' => '',
    'href' => '#',
    'linkClass' => ''
])
<a href="{{ $href }}" class="{{ $linkClass }}">
    <img {{ $attributes }} src="{{ $src }}">
</a>