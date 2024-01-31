<?php

namespace App\Livewire;

use App\Livewire\Forms\ProfileCompletionForm;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class ProfileCompletion extends Component
{
    use LivewireAlert;

    public ProfileCompletionForm $form;

    public function mount()
    {
        $this->form->setProfile();
    }

    public function save()
    {

        $this->validate();

        $this->form->store();

        $this->alert('success', "حساب کاربری با موفقیت بروزرسانی شد", ['toast' => false]);
        return $this->redirect(route('user.profile'), navigate: true);
    }

    public function render()
    {
        return view('livewire.profile-completion');
    }
}
