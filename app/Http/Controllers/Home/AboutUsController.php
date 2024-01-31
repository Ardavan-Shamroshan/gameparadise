<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Setting\Setting;

class AboutUsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $setting = Setting::query()->first();
        return view('home.about-us', compact('setting'));
    }
}
