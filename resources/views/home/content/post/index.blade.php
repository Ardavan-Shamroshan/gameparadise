<x-home.layout>


    <x-home.breadcrumb>
        <x-slot:breadcrumbs>
            <li class="icon-keyboard_arrow_left"><a wire:navigate.hover href="{{ route('home')  }}"> خانه </a></li>
            <li class="icon-1"><a> مقالات </a></li>
        </x-slot:breadcrumbs>
    </x-home.breadcrumb>

    <div class="tf-section-5 artwork loadmore-12-item-1">
        <div class="themesflat-container">
            <livewire:posts-filter/>
        </div>
    </div>

    <x-home.footer/>

</x-home.layout>