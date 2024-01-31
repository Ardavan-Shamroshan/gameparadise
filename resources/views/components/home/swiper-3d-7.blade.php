<div class="swiper-slide">
    <div class="tf-card-box" :class="{ 'style-1 bg-white' : Light }">
        <div class="card-media border-gray">
            @if(is_null($gameSlide->slideable_type))
                <a href="{{ $gameSlide->url }}">
                    @else
                        <a href="{{ route('slides', ['slide' => $gameSlide]) }}">
                            @endif
                            <img src="{{ asset('storage/'.$gameSlide->image ?? '') }}"
                                 alt="{{ $gameSlide->name ?? '' }}">
                        </a>
                        <div class="button-place-bid">
                            @if(is_null($gameSlide->slideable_type))
                                <a href="{{ $gameSlide->url }}" class="tf-button blue-btn"><span>{{ $modalText }}</span></a>
                            @else
                                <a href="{{ route('slides', ['slide' => $gameSlide]) }}" class="tf-button blue-btn"><span>{{ $modalText }}</span></a>
                            @endif
                        </div>
        </div>
        <div class="meta-info text-center">
            <h3 class="name" dir="rtl"><a href="{{ url($gameSlide->url) }}">{{ $gameSlide->name ?? '' }}</a></h3>
        </div>
    </div>
</div>
