@props([
    'filters',
    'wireModel',
    'filterType',
    'filterName',
    'wireClick' => 'filter'
])

<div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle" @style(['border: 1px solid rgba(255, 255, 255, 0.12); background-color: #4794f2;color: #292b2c;' =>  $this->$wireModel]) type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{ $icon }}
        <span class="inner">{{ $filterName }}</span>
    </button>

    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        @forelse($filters as $filter)
{{--            <a wire:click="{{ $wireClick }}" class="dropdown-item">--}}
            <a class="dropdown-item">
                <label for="{{ $filterType }}-{{ $filter->id }}" @class(["sort-filter", 'active' => in_array($filter->id, array_keys($this->$wireModel))])>
                    <span>{{ $filter->name ?? '' }}</span>
                    <span class="icon-tick"><span class="path2"></span></span>
                    <input wire:model.live="{{ $wireModel }}.{{ $filter->id }}" id="{{ $filterType }}-{{ $filter->id }}" type="checkbox" value="{{ $filter->id }}">
                </label>
            </a>
        @empty
        @endforelse
    </div>
</div>