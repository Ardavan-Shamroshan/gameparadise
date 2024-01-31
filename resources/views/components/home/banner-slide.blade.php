@props([
    'slide'
])

<div class="swiper-slide taxonomies-slide">
    <div class="tf-category text-center p-0">
        <div class="card-media border-gray">
            @if($slide->image)
                <img src="{{ asset('storage/' . $slide->image) }}" alt="{{ $slide->name ?? '' }}">
            @endif
            <a href="{{ route('slides', ['slide' => $slide]) }}" class="blue-btn"><i class="icon-arrow-up-right2"></i></a>
        </div>
    </div>
</div>

