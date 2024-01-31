<?php

namespace App\Livewire;

use Livewire\Component;

class WishlistButton extends Component
{
    public $morphedTo;

    public function mount($morphedTo)
    {
        $this->morphedTo = $morphedTo;
    }

    public function like()
    {
        $this->morphedTo->toggleLike();
    }

    public function render()
    {
        return view('livewire.wishlist-button');
    }
}
