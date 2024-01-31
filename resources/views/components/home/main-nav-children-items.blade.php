@forelse($items as $item)
    <li class="nav-menu-item text-nowrap"><a href="{{ url($item->value ?? '') }}">{{ $item->name ?? '' }}</a>

        <x-home.main-nav-children-items :items="$item->children"/>
    </li>
@empty
@endforelse
