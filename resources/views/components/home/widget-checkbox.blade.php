@props([
    'collection',
    'wireModel',
    'title'
])

<div class='widget-category-checkbox style-1 mb-30' {{ $attributes }}>
    <h5>{{ $title }}</h5>
    <div class="content-wg-category-checkbox" dir="rtl">
        @forelse($collection as $model)
            @if($model instanceof \App\Models\Media\Video\Video)
                @php($name = $model->videoable?->title)
            @elseif($model instanceof \App\Models\Content\Category\Category)
                @php($name = $model->name)
            @endif

            <a wire:click="filter">
                <label for="{{ $wireModel }}-{{ $model->id }}" class="flex">
                    <input wire:model="{{ $wireModel }}.{{ $model->id }}" id="{{ $wireModel }}-{{ $model->id }}" type="checkbox" value="{{ $model->id }}">
                    <span class="btn-checkbox"></span>
                    {{ $name }}
                </label><br>
            </a>
        @empty
        @endforelse
    </div>
</div>
