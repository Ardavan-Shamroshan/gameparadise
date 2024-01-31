@props(['title', 'wireModel', 'wireClick'])

<button type="button" wire:model="{{ $wireModel }}" wire:click="{{ $wireClick }}" class="bg-dark-transparent border-gray py-1 tf-btn-fill text-white wow fadeIn" data-wow-delay="0.01s">
    <span wire:loading.remove wire:target="{{ $wireModel }}">{{ $title }}</span>
    <span wire:loading wire:target="{{ $wireModel }}"> <i class="fa fa-spin fa-spinner spinner spinner-icon"></i></span>
</button>