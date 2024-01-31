@if($children->isNotEmpty())
    <ul class="sub-menu-mobile">
        @forelse($children as $menu)
            <li @class([
            "menu-item", 'has-item' => $menu->children->isNotEmpty(),
            "current-item" => (request()->route()->uri == $menu->value)
            ])>
                <a href="{{ url($menu->value ?? '') }}" wire:navigate.hover>{{ $menu->name ?? '' }}</a>

                @if($menu->children->isNotEmpty())
                    <ul class="nav-sub-menu">
{{--                        <x-home.main-nav-children-items :items="$menu->children"/>--}}
                    </ul>
                @endif

            </li>
        @empty
        @endforelse
    </ul>
@endif