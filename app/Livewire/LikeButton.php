<?php

namespace App\Livewire;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class LikeButton extends Component
{
    use LivewireAlert;

    public $morphedTo;

    public function mount($morphedTo)
    {
        $this->morphedTo = $morphedTo;
    }

    public function like()
    {
        if (! auth()->check()) {
            $this->alert('info', "برای لایک کردن مطلب وارد حساب کاربری خود شوید");
        } else {
            $this->morphedTo->toggleLike();
        }
    }

    public function render()
    {
        return view('livewire.like-button');
    }
}
