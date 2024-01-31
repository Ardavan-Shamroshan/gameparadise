<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Content\Category\Category;
use App\Models\Content\Taxonomy;
use App\Models\GameNet\Publisher;
use App\Models\Setting\Slideshow\Slide;
use App\Models\Shop\Product\Brand;
use Butschster\Head\Facades\Meta;
use Exception;

class SlideshowController extends Controller
{
    /**
     * @throws Exception
     */
    public function index(Slide $slide)
    {
        Meta::setTitle($slide->name);

        if (is_null($slide->slideable_type))
            return to_route('home');


        $model = match ($slide->slideable_type) {
            Publisher::class => Publisher::query(),
            Taxonomy::class => Taxonomy::query(),
            Category::class => Category::query(),
            Brand::class => Brand::query(),
            default => throw new Exception('Unsupported'),
        };

        $collection = $model->where('slug', $slide->url)->first();

        $sidebarCategories = cache()->remember("sidebar-categories", now()->addHour(), function () {
            return Category::whereHas('products')
                ->orWhereHas('games')
                ->orWhereHas('posts')
                ->with(['products', 'posts', 'games'])
                ->parents()
                ->get();
        });


        return view('home.taxonomy', compact('collection', 'sidebarCategories'));
    }
}
