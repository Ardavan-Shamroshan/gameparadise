<?php

namespace App\Http\Controllers\Home;

use App\Enum\SlideShowPosition;
use App\Http\Controllers\Controller;
use App\Models\Content\Category\Category;
use App\Models\Content\Post\Post;
use App\Models\GameNet\Genre;
use App\Models\GameNet\Publisher;
use App\Models\Setting\Setting;
use App\Models\Setting\Slideshow\Slideshow;
use Butschster\Head\Facades\Meta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        visitor()->visit(); // create a visit log

        // Prepend title part to the default title
        Meta::setTitle('فروشگاه اکانت قانونی بازی و کنسول های بازی و لوازم جانبی گیم پردایس');

        $setting = Cache::remember('home-setting', 24 * 60 * 60, function () {
            return Setting::latest()->first();
        });

        $slideshows               = Cache::remember('home-slideshows', now()->addMinutes(30), function () {
            return Slideshow::query()->whereIn('position', SlideShowPosition::cases())->get();
        });
        $gamesSlideshow           = $slideshows->where('position', SlideShowPosition::HOME_TOP)->first();
        $underTopSlideshow        = $slideshows->where('position', SlideShowPosition::HOME_UNDER_TOP)->first();
        $middleSlideshow          = $slideshows->where('position', SlideShowPosition::HOME_MIDDLE)->first();
        $middleSlideshowSecondRow = $slideshows->where('position', SlideShowPosition::HOME_MIDDLE_SECOND_ROW)->first();
        $underMiddleSlideshow     = $slideshows->where('position', SlideShowPosition::HOME_UNDER_MIDDLE)->first();
        $bottomSlideshow          = $slideshows->where('position', SlideShowPosition::HOME_BOTTOM)->first();
        $underBottomSlideshow     = $slideshows->where('position', SlideShowPosition::HOME_UNDER_BOTTOM)->first();


        $topPublishers = Cache::remember('home-top-publishers', now()->addMinutes(30), function () {
            return Publisher::with('games')
                ->whereHas('games')
                ->take(10)
                ->get();
        });

        $recentPosts = Cache::remember('home-recent-posts', now()->addMinutes(30), function () {
            return Post::with('categories', 'likes', 'tags', 'user', 'comments')
                ->withCount('comments')
                ->latest()
                ->active()
                ->take(10)
                ->get();
        });

        $categories = Cache::remember('home-categories', now()->addMinutes(30), function () {
            return Category::with('posts', 'products', 'tags')
                ->whereHas('posts')
                ->orWhereHas('products')
                ->active()
                ->get();
        });

        $genres = Cache::remember('home-genres', now()->addMinutes(30), function () {
            return Genre::with('games')
                ->whereHas('games')
                ->active()
                ->get();
        });

        $consolesCategory = cache()->remember('home-console-products', now()->addMinutes(30), function () {
            return Category::query()
                ->where('slug', 'consoles')
                ->whereHas('products')
                ->first();
        });


        $accessoriesCategory = cache()->remember('home-accessories-products', now()->addMinutes(30), function () {
            return Category::query()
                ->where('slug', 'accessories')
                ->whereHas('products')
                ->first();
        });

        $giftCardCategory = cache()->remember('home-gift-card-products', now()->addMinutes(30), function () {
            return Category::query()
                ->where('slug', 'gift-card')
                ->whereHas('products')
                ->first();
        });


        return view('home.index', compact(
            'setting',
            'gamesSlideshow',
            'underTopSlideshow',
            'middleSlideshow',
            'middleSlideshowSecondRow',
            'underMiddleSlideshow',
            'bottomSlideshow',
            'underBottomSlideshow',
            'topPublishers',
            'recentPosts',
            'categories',
            'genres',
            'consolesCategory',
            'accessoriesCategory',
            'giftCardCategory',
        ));
    }
}
