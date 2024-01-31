@props([
    'href',
    'title'
])

<a
        href="{{ $href }}" {{ $attributes->class(['tf-button']) }}>
    <span>{{ $title }}</span>
</a>