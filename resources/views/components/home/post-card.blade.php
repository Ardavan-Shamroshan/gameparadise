<div class="tf-card-box style-4">

    <div class="card-media border-gray">
        <a href="{{ route('content.posts.show', $post->slug) }}" wire:navigate.hover>
            <img src="{{ asset($post->image?->first()?->thumbnail_url) }}" alt="{{ $post->title ?? '' }}">
        </a>
    </div>

    <h2 class="name text-truncate"><a href="{{ route('content.posts.show', $post->slug) }}" class="small" wire:navigate.hover>{{ \Illuminate\Support\Str::limit($post->title ?? '', 25) }}</a></h2>
    <div class="meta-info flex items-center justify-center">
        <div class="button-place-bid">
            <a href="{{ route('content.posts.show', $post->slug) }}" class="tf-button blue-btn"><span>بیشتر</span></a>
        </div>
    </div>
</div>
