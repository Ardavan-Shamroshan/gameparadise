<?php

namespace App\Livewire;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Ratings extends Component
{
    use LivewireAlert;

    public $morphedTo;
    public $content;

    #[Rule(['required', 'in:1,2,3,4,5'])]
    public $rating;

    public $userRating = null;
    public $rated      = null;
    public $averageRating;
    public $usersRated;

    protected $listeners = [
        'confirmed'
    ];

    public function mount($morphedTo, $content = '')
    {
        $this->content       = $content;
        $this->morphedTo     = $morphedTo;
        $this->userRating    = $this->morphedTo->userRating();
        $this->rated         = (bool)$this->morphedTo->userRating();
        $this->averageRating = ceil($this->morphedTo->averageRating());
        $this->usersRated    = $this->morphedTo->usersRated();
    }

    public function render()
    {
        return view('livewire.ratings');
    }

    public function updated()
    {
        $this->validate();

        $this->alert('question', 'آیا میخواهید امتیاز خود را ثبت کنید؟', [
            'toast'             => false,
            'position'          => 'center',
            'showConfirmButton' => true,
            'showCancelButton'  => true,
            'confirmButtonText' => 'بله',
            'cancelButtonText'  => 'خیر',
            'onConfirmed'       => 'confirmed',
            'allowOutsideClick' => false,
            'timer'             => null
        ]);
    }

    public function confirmed()
    {
        try {
            $this->morphedTo->rateOnce((int)$this->rating);
        } catch (\Exception $exception) {
            $this->alert('error', 'مشکلی رخ داده است. دوباره تلاش کنید');
        }
        $this->alert('success', 'امتیاز شما با موفقیت ثبت شد');
    }
}
