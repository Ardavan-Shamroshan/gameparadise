<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Setting\Faq\Faq;
use Butschster\Head\Facades\Meta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class FaqController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        Meta::setTitle('پرسش های پر تکرار');

        $faqs = Cache::remember('home-faqs', now()->addMinutes(30), function () {
            return Faq::all();
        });
        return view('home.faq', compact('faqs'));
    }
}
