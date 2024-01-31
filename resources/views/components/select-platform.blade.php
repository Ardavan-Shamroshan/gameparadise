@props([
        'value',
])

<label {{ $attributes->merge(['class' => 'meta-item platform-btn view cursor-pointer radio-platform-checked']) }}>
    {{ $slot }}
</label>