<?php

namespace App\Livewire\Forms;

use App\Rules\NationalCodeRule;
use Illuminate\Validation\Rule;
use Livewire\Form;

class ProfileCompletionForm extends Form
{
    public $name;

    public $email;

    public $mobile;

    // #[Rule(['required', new NationalCodeRule, 'unique:profiles,national_code'])]
    public $nationalCode;

    public function rules()
    {
        return [
            'nationalCode' => ['required', new NationalCodeRule],
            'mobile'       => 'required|min_digits:11|starts_with:09|numeric',
            'name'         => 'required|string|max:255',
            'email'        => ['required', 'string', 'email', Rule::unique('users', 'email')->ignore(auth()->id())]
        ];
    }

    public function setProfile()
    {
        $this->name = auth()->user()->name;
        $this->email = auth()->user()->email;
        $this->mobile = auth()->user()->mobile;
        $this->nationalCode = auth()->user()->profile?->national_code;
    }

    public function store()
    {
        auth()->user()->forceFill([
            'name'               => auth()->user()->name ?? $this->name,
            'email'              => auth()->user()->email ?? $this->email,
            'mobile'             => auth()->user()->mobile ?? $this->mobile,
            'mobile_verified_at' => auth()->user()->mobile_verified_at ?? now(),
            'email_verified_at'  => auth()->user()->email_verified_at ?? now()
        ])->save();

        if (auth()->user()->profile) {
            auth()->user()->profile?->forceFill([
                'national_code' => auth()->user()->profile?->nationalCode ?? $this->nationalCode,
            ])->save();
        } else {
            auth()->user()->profile()->create([
                'national_code' => $this->nationalCode,
            ]);
        }

    }
}