@props([
    'tags'
])

<div {{ $attributes->class(['widget-tag flex items-center gap4']) }}>
    <h3 class="title-widget"> تگ ها: </h3>
    <ul class="flex flex-wrap gap4 items-center">
        @forelse($tags as $tag)
            <li><a wire:navigate.hover href="#" class="tag"> {{ $tag }} </a></li>
        @empty
        @endforelse
    </ul>
</div>