@props([
    'themesflatContainerClass'  => '',
    'column'                    => 'col-md-12',
    'headerColumn'              => 'col-md-12',
    'headingSectionClass'       => '',
    'heading'                   => 'عنوان هدر',
    'headingSection'            => '',
])

<div {{ $attributes->class(['tf-section-2 featured-item style-bottom pb-0']) }} {{ $attributes }}>
    <div class="themesflat-container {{ $themesflatContainerClass }}">
        <div class="row">
            <div class="{{ $headerColumn }}" dir="rtl">
                <div class="heading-section pb-20 {{ $headingSectionClass }}">
                    <h1>{{ $heading }}</h1>
                    {{ $headingSection }}
                </div>
            </div>

            <div class="{{ $column }}" dir="rtl">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>