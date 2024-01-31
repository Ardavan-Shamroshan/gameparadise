<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Setting\Page\Page;
use Butschster\Head\Facades\Meta;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Page $page)
    {
        Meta::setTitle($page->title);

        $pages = cache()->remember("pages", now()->addMinutes(30), fn() => Page::query()->active()->get());
        return view('home.page', compact('page', 'pages'));
    }
}
