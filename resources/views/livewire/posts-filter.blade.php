<div class="row flex-row-reverse">

    <div class="col-md-3 col-sm-4">
{{--        <x-home.widget-checkbox :collection="$videos" title="ویدیو ها" wire-model="selectedVideos"/>--}}
        <x-home.widget-checkbox :collection="$postCategories" title="دسته بندی ها" wire-model="selectedCategories"/>
    </div>

    <div class="col-md-9 col-sm-8">
        <div class="row" dir="rtl">
            @forelse($posts as $post)
                <div class="wow fadeInUp col-lg-4 col-md-6 w-50" dir="rtl" wire:ignore wire:key="post-card-{{ $post->id }}">
                    <x-home.post-card :$post/>
                </div>
            @empty
            @endforelse
        </div>
    </div>

    <x-home.button-loadmore text="بیشتر"/>
</div>
