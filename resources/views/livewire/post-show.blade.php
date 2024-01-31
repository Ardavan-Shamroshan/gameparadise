<div>


    <x-home.breadcrumb>
        <x-slot:breadcrumbs>
            <li class="icon-keyboard_arrow_left"><a wire:navigate.hover href="{{ route('home') }}"> خانه </a></li>
            <li class="icon-keyboard_arrow_left"><a wire:navigate.hover href="{{ route('content.posts') }}"> مقالات </a></li>
            <li dir="rtl" class="icon-1"><a> {{ $post->title }} </a></li>
        </x-slot:breadcrumbs>
    </x-home.breadcrumb>

    <div class="tf-section tf-blog-detail pb-48">
        <div class="themesflat-container">
            <div class="row">
                <div class="wrapper col-md-8" dir="rtl">
                    <div class="inner-content mr-20">
                        <h1 class="title-post h2">{{ $post->title ?? '' }}</h1>
                        <div class="meta-post flex justify-between mt-10 items-center">
                            <div class="author flex items-center justify-between">
                                @if($post->user->profile_photo_path)
                                    <div class="avatar">
                                        <img src="{{ asset($post->user->profile_photo_path) }}" alt="{{ $post->user->name ?? '' }}">
                                    </div>
                                @endif
                                <div class="info">
                                    <span>نویسنده</span>
                                    <h3><a wire:navigate.hover href="#">{{ $post->user->name ?? '' }}</a></h3>
                                </div>
                            </div>
                            <div class="meta-info flex-wrap flex gap30">
                                <div class="item art active">
                                    @foreach($post->categories->pluck('name') as $categoryName)
                                        <a wire:navigate.hover href="#"> {{ $categoryName }} </a>
                                    @endforeach
                                </div>
                                <div class="item date"> {{ jalaliDate($post->published_at) }} </div>
                                <div class="item comment"> {{ $post->comments->count() }} دیدگاه</div>
                                <div class="item"> {{ $post->visitLogs()->distinct('ip')->count('ip') }} بازدید</div>
                            </div>
                        </div>
                        <div class="divider"></div>
                        <div class="bg-dark-transparent border-gray rounded-20 tf-btn">
                            <div class="text">{!! $post->summary ?? '' !!}</div>
                            <div class="image"><img src="{{ asset($post->image?->first()->thumbnail_url) ?? '' }}" class="border-gray" alt="{{ $post->title ?? '' }}"></div>
                            <div class="inner-post text">{!! $post->body ?? '' !!}</div>
                            <div class="divider style-1"></div>
                            <livewire:like-button wire:model="morphedTo" wire:key="like-post-{{ $post->id }}" :morphedTo="$post"/>
                        </div>

                        <div class="divider style-1"></div>

                        @if($videos->isNotEmpty())
                            <div class="col-md-12">
                                <div class="featured py-10 swiper-container carousel3 product-item" data-swiper='{
                                "loop":false,
                                "slidesPerView": 1,
                                "spaceBetween": 30,
                                "observer": true,
                                "observeParents": true,
                                "breakpoints": {
                                    "600": {
                                        "slidesPerView": 2
                                    },
                                    "991": {
                                        "slidesPerView": 3
                                    }
                                }
                            }'>
                                    <div class="swiper-wrapper">
                                        @foreach($videos as $video)
                                            @if($video->uploaded)
                                                <video controls class="w-100 h-100 mb-0" preload="none">
                                                    <source src="{{ asset('uploads/media/' . $video->cover) }}" type="video/mp4">
                                                    <source src="{{ asset('uploads/media/' . $video->cover) }}" type="video/ogg">
                                                    مرورگر شما تگ ویدیو را پشتیبانی نمیکند.
                                                </video>
                                            @else
                                                {!!  $video->url  !!}
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="bottom flex justify-between items-center gap4">
                            @if($post->tags->isNotEmpty())
                                @php($tags = $post->tags->pluck('name'))
                                <x-home.tag :tags="$tags"/>
                            @endif
                        </div>

                        @if($previousPost || $nextPost)
                            <div class="related-post">
                                @isset($nextPost)
                                    <div class="next">
                                        <a wire:navigate.hover href="{{ route('content.posts.show', $nextPost) }}" wire:navigate.hover><i class="icon-keyboard_arrow_right"></i>نوشته بعدی</a>
                                        <div class="action items-center right flex mt-16">
                                            <img src="{{ asset($nextPost->image?->first()?->thumbnail_url) ?? '' }}" alt="{{ $nextPost->title ?? '' }}">
                                            <div class="content">
                                                <h2>{{ $nextPost->title }}</h2>
                                                <div class="meta-info flex">
                                                    <div class="item date">{{ jalaliDate($nextPost->published_at) }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endisset
                                @isset($previousPost)
                                    <div class="prev text-end">
                                        <a wire:navigate.hover href="{{ route('content.posts.show', $previousPost) }}" wire:navigate.hover>نوشته قبلی<i class="icon-keyboard_arrow_left"></i></a>
                                        <div class="action flex justify-end left mt-16">
                                            <div class="content">
                                                <h2>{{ $previousPost->title }}</h2>
                                                <div class="meta-info flex">
                                                    <div class="item date">{{ jalaliDate($previousPost->published_at) }}</div>
                                                </div>
                                            </div>
                                            <img src="{{ asset($previousPost->image?->first()?->thumbnail_url) ?? '' }}" alt="{{ $nextPost->title ?? '' }}">
                                        </div>
                                    </div>
                                @endisset
                            </div>
                        @endif

                        @if($post->commentable)
                            <div class="widget-reply mt-2">
                                <div class="d-flex flex-row-reverse justify-content-between">
                                    <livewire:ratings :morphedTo="$post" content="شما هم به این مطلب امتیاز دهید"/>

                                    <h3>({{ $post->comments?->count() ?? 0 }}) دیدگاه </h3>
                                </div>
                                @guest
                                    <x-home.guest-comment-form/>
                                @endguest
                                @auth
                                    <h3 class="heading">دیدگاه خود را ثبت کنید</h3>
                                    <p>ایمیل شما نمایش داده نخواهد شد. موارد الزامی با * مشخص شده اند</p>
                                    <x-home.authenticated-comment-form :model="$post"/>
                                @endauth
                            </div>
                            <div class="widget-comment">
                                <ul>
                                    @forelse($comments as $comment)
                                        <x-home.comment-box :comment="$comment"/>

                                        @forelse($comment->approvedReplies() as $reply)
                                            <x-home.comment-box class="rep" :comment="$reply"/>
                                        @empty
                                        @endforelse

                                    @empty
                                    @endforelse
                                    @forelse($userPendingComments as $userPendingComment)
                                        <x-home.comment-box :pending="true" :comment="$userPendingComment"/>
                                    @empty
                                    @endforelse
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="side-bar col-md-4">
                    <x-home.widget-sidebar :collection="$postCategories" title="دسته بندی ها"/>
                    @if($relatedPosts->isNotEmpty())
                        <div class="widget widget-related-posts text-right border-gray">
                            <h2 class="title-widget">نوشته های مرتبط</h2>

                            @forelse($relatedPosts as $relatedPost)
                                @if($loop->iteration == 1)
                                    <div class="related-posts-item main gap4" dir="rtl">
                                        <div class="card-media border-gray">
                                            <img src="{{ asset($relatedPost->image?->first()?->thumbnail_url) ?? '' }}" alt="{{ $relatedPost->title ?? '' }}">
                                        </div>
                                        <div class="meta-info flex gap30">
                                            @foreach($relatedPost->categories->pluck('name') as $categoryName)
                                                <div class="item art active"> {{ $categoryName }} </div>
                                            @endforeach
                                            <div class="item date">{{ jalaliDate($relatedPost->published_at) }}</div>
                                        </div>
                                        <h2><a wire:navigate.hover href="{{ route('content.posts.show', $relatedPost) }}">{{ $relatedPost->title ?? '' }}</a></h2>
                                    </div>
                                @else
                                    <div class="related-posts-item gap4">
                                        <div class="card-content d-flex flex-column gap4">
                                            <h3 dir="rtl"><a wire:navigate.hover href="{{ route('content.posts.show', $relatedPost) }}">{{ $relatedPost->title ?? '' }}</a></h3>
                                            <div class="item date">{{ jalaliDate($relatedPost->published_at) }}</div>
                                        </div>
                                        <div class="card-media border-gray">
                                            <img src="{{ asset($relatedPost->image?->first()->thumbnail_url) ?? '' }}" alt="{{ $relatedPost->title ?? '' }}" width="140" height="140">
                                        </div>
                                    </div>
                                @endif
                            @empty
                            @endforelse
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <x-home.footer/>
</div>

