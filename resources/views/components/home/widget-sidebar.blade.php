@props([
    'collection',
    'title'
])

<div {{ $attributes->class(['widget widget-categories border-gray bg-dark-transparent']) }}>
    <h2 class="title-widget text-right">{{ $title }}</h2>
    <ul>
        @forelse($collection as $item)
            <li dir="rtl">
                <div class="cate-item"><a wire:navigate.hover href="{{ route('category.show', $item) }}">{{ $item->name ?? '' }}</a></div>
                @if($item instanceof \App\Models\Content\Category\Category)
                    <div class="number">({{ $item->posts->count() }})</div>
                @endif
            </li>
        @empty
        @endforelse
    </ul>
</div>