@props([
    'dir' => 'rtl',
    'themesflatContainerClass' => '',
    'column' => 'col-md-12',
])

<div {{ $attributes->class(['tf-section seller my-4 pb-0']) }} dir="{{ $dir }}">
    <div class="themesflat-container {{ $themesflatContainerClass }}">
        <div class="row">
            <div class="{{ $column }}">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>