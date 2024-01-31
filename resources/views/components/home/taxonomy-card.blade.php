@props([
    'collection',
    'collectionName' =>'',
    'title' => '',
    'href' => ''
])

<div {{ $attributes->class(['col-md-12']) }} dir="ltr">
    <div class="heading-section pb-30" dir="rtl" >
{{--        <a wire:navigate href="{{ $href }}"> جستجوی بیشتر <i class="icon-arrow-left2"></i></a>--}}
        <h1 class="h1"> {{ $title }}</h1>
    </div>
</div>

{{ $slot }}

<div class="col-md-12">
    {{ $collection->links(data: ['scrollTo' => false]) }}
</div>