<div class="swiper-slide">
    <div class="tf-author-box style-1 text-center flex">
        @if($model->image?->first())
            <div class="author-avatar">
                <img src="assets/images/avatar/avatar-small-01.png" alt="{{ $model->name ?? '' }}" class="avatar">
            </div>
        @endif
        <div class="author-info">
            <h2><a href="#">{{ $model->name ?? '' }}</a></h2>
        </div>
    </div>
</div>
