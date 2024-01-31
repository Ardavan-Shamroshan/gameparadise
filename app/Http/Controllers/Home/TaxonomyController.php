<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Content\Category\Category;
use App\Models\Content\Taxonomy;
use App\Models\GameNet\Publisher;
use App\Models\Shop\Product\Brand;
use Butschster\Head\Facades\Meta;
use Exception;

class TaxonomyController extends Controller
{
    /**
     * @throws Exception
     */
    public function index(?string $typeof, $id)
    {

        $model = match ($typeof) {
            'publisher' => Publisher::query(),
            'taxonomy' => Taxonomy::query(),
            'category' => Category::query(),
            'brand' => Brand::query(),
            default => throw new Exception('Unsupported'),
        };

        $collection = $model->findOrFail($id);

        Meta::setTitle($collection->meta_title ?? $collection->name)
            ->setDescription($collection->meta_description);

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
