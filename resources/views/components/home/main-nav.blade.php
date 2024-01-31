<nav id="main-nav" {{ $attributes->merge(["class" => "main-nav"]) }}>
    <ul id="menu-primary-menu" class="menu mx-5">
        @forelse($parentMenus as $parent)

            @php($active = false)
            @if($parent->children->isNotEmpty())
                @php($active = false)
                @foreach($parent->children->pluck('value') as $childUrl)
                    @if($childUrl == request()->route()->uri)
                        @php($active = true)
                    @endif
                @endforeach
            @endif

            <li @class([
            "menu-item py-0 text-nowrap",
             "menu-item-has-children" => $parent->children->isNotEmpty(),
             "current-menu-item" => ((request()->route()->uri == $parent->value) || $active)
             ])>

                @if($parent->children->isNotEmpty())
                    <a href="{{ url($parent->value ?? $parent->children[0]->value ?? '') }}" wire:navigate.hover>{{ $parent->name ?? '' }}</a>
                @else
                    <a href="{{ url($parent->value ?? '') }}" wire:navigate.hover>{{ $parent->name ?? '' }}</a>
                @endif

                @if($parent->children->isNotEmpty())
                    <x-home.main-nav-children :children="$parent->children"/>
                @endif
            </li>
        @empty
        @endforelse
    </ul>
</nav>
