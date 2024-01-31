<div class="swiper-slide publishers-slide" style="width: auto">
    <div class="tf-author-box style-3 text-center">
        <div class="author-avatar ">
            <a href="{{ route('slides', ['slide' => $underTopSlide]) }}"> <img src="{{ asset('storage/' . $underTopSlide->image) ?? 'assets/images/box-icon/wallet-07.png' }}" alt="{{ $underTopSlide->name ?? ''}}" class="avatar" width="106" height="106"></a>
        </div>
    </div>
</div>