<?php

namespace App\Providers;

use App\Enum\SlideShowPosition;
use App\Models\Content\Category\Category;
use App\Models\Setting\Menu\Menu;
use App\Models\Setting\Setting;
use App\Models\Setting\Slideshow\Slideshow;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Using class based composers...
        view()->composer(['layouts.home.header', 'layouts.home.footer'], function ($view) {
            $menu = cache()->remember("menus", now()->addHour(), function () {
                return Menu::with('rootMenuItems')->get();
            });

            $headerMenu = $menu->where('slug', 'header')->first()->rootMenuItems()->with('children')->whereNull('parent_id')->get();
            $footerMenu = $menu->where('slug', 'footer')->first()->rootMenuItems()->with('children')->whereNull('parent_id')->get();

            $categories        = Category::query()->with('subcategories')->whereHas('products')->orWhereHas('posts')->orWhereHas('games')->parents();
            $productCategories = $categories->whereHas('products')->get();
            $gameCategories    = $categories->whereHas('games')->get();
            $postCategories    = Category::with('posts')->whereHas('posts')->get();

            $setting = cache()->remember('setting', now()->addHour(), function () {
                return Setting::query()->latest()->firstOrFail();
            });

            $view->with('footerParentMenuItems', $footerMenu)
                ->with('headerParentMenuItems', $headerMenu)
                ->with('productCategories', $productCategories)
                ->with('postCategories', $postCategories)
                ->with('gameCategories', $gameCategories)
                ->with('setting', $setting);
        });
        view()->composer(['layouts.home.layout'], function ($view) {
            $banner = Cache::remember('banner', now()->addMinutes(30), function () {
                return Slideshow::query()->where('position', SlideShowPosition::TOP_HEADER)->first();
            })?->slides()?->latest()->first();

            $view->with('banner', $banner);
        });

    }
}
