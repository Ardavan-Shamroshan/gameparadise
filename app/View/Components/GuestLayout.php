<?php

namespace App\View\Components;

use App\Models\Setting\Setting;
use Illuminate\View\Component;
use Illuminate\View\View;

class GuestLayout extends Component
{

    public $setting;

    public function __construct()
    {
        $this->setting = cache()->remember('setting', now()->addHour(), function () {
            return Setting::query()->latest()->firstOrFail();
        });
    }

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('layouts.guest');
    }
}
