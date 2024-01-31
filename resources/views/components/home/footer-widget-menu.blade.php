@forelse($parentMenus as $parent)
    <div class="widget-menu style-{{ $loop->iteration }}">
        <h2 class="title-widget">{{ $parent->name ?? '' }}</h2>
        @if($parent->children->isNotEmpty())
        <ul>
            @foreach($parent->children as $child)
                <li><a href="{{ url($child->value ?? '') }}">{{ $child->name ?? '' }}</a></li>
            @endforeach
        </ul>
        @endif
    </div>
    @empty
@endforelse