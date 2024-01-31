<div style="height: 3rem" class="gap4 d-flex align-items-center">
    <img wire:loading.remove @class(['svg-icon','active' => $morphedTo->liked()]) wire:click="like" src="{{ asset('assets/images/thumb-up.svg') }}" alt="thumb-up">
    <i class="fa fa-spin fa-spinner sub-text" wire:loading></i>
    <p class="text-white">{{ $morphedTo->likeCount }}</p>
</div>
