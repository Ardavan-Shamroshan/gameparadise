@props([
    'page' => '',
    'breadcrumbs'
])

<div {{ $attributes->class(['flat-title-page py-5']) }}>
    <div class="themesflat-container">
        <div class="row">
            <div class="col-12">
                @if($page)
                    <h1 class="heading text-center" dir="rtl">{{ $page }}</h1>
                @endif
                <ul class="breadcrumbs flex flex-row-reverse flex-wrap">
                    {{ $breadcrumbs }}
                </ul>
            </div>
        </div>
    </div>
</div>