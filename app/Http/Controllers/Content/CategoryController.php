<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Models\Content\Category\Category;
use Butschster\Head\Facades\Meta;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        Meta::setTitle($category->meta_title ?? $category->name)
            ->setDescription($category->meta_description);

        $sidebarCategories = cache()->remember("sidebar-categories", now()->addHour(), function () {
            return Category::whereHas('products')
                ->orWhereHas('games')
                ->orWhereHas('posts')
                ->with(['products', 'posts', 'games'])
                ->parents()
                ->get();
        });

        return view('home.taxonomy', ['collection' => $category, 'sidebarCategories' => $sidebarCategories]);
    }
}
