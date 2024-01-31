@props([
    'collection',
    'title',
    'href' => 'home'
])

<div class='widget-category-checkbox style-1 mt-4' {{ $attributes }}>
    <h2 class="active">{{ $title }}</h2>
    <div class="content-wg-category-checkbox" dir="rtl">
        @forelse($collection as $model)
{{--            <a wire:navigate.hover href="{{ route('taxonomy', ['typeof' => 'category', 'id' => $model]) }}">--}}
            <a wire:navigate.hover href="{{ route('category.show', $model) }}">
                <label  class="flex">
                    {{ $model->name ?? '' }}
                </label>
            </a>
        @empty
        @endforelse
    </div>
</div>