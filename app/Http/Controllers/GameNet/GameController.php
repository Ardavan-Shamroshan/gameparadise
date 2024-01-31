<?php

namespace App\Http\Controllers\GameNet;

use App\Enum\SlideShowPosition;
use App\Http\Controllers\Controller;
use App\Models\GameNet\Game;
use App\Models\Media\Video\Video;
use App\Models\Setting\Slideshow\Slideshow;
use Butschster\Head\Facades\Meta;
use Illuminate\Support\Facades\Cache;

class GameController extends Controller
{
    public function index()
    {
        Meta::setTitle('اکانت های قانونی PS5 & PS4');

        $recentGames = Cache::remember('game-net-games', now()->addMinutes(30), function () {
            return Game::with('publisher', 'likes', 'genres', 'account')
                ->orderBy('released_at')
                ->active()
                ->take(10)
                ->get();
        });

        $gameSlide = Cache::remember('games-slideshows', now()->addMinutes(30), function () {
            return Slideshow::query()->where('position', SlideShowPosition::LEGAL_ACCOUNTS_TOP)->first();
        });

        return view('home.game-net.game.index', compact('gameSlide', 'recentGames'));
    }

    public function show(Game $game)
    {
        Meta::setTitle($game->meta_title ?? $game->name)
            ->setDescription($game->meta_description);

        // $recentPosts = Cache::remember('game-net-game-recent-posts', now()->addMinutes(30), function () {
        //     $category = Category::query()->where('slug', 'game-paradise')->first();
        //     return $category->posts()->with('categories', 'likes', 'tags', 'user', 'comments')
        //         ->orderBy('created_at')
        //         ->active()
        //         ->take(10)
        //         ->get();
        // });

        $videos = Cache::remember('game-net-game-videos', now()->addMinutes(30), function () {
            return Video::query()
                ->morphTo(Game::class)
                ->linked()
                ->get();
        });

        $relatedGames = cache()->remember("game-{$game->slug}-related-games", now()->addMinutes(30), function () use ($game) {
            return $game->relatedAccounts();
        });


        $comments = $game->comments()
            ->comment()
            ->approved()
            ->active()
            ->seen()
            ->get();

        $userPendingComments = $game->comments()
            ->where('user_id', auth()->id())
            ->pending()
            ->get();

        return view('home.game-net.game.show', compact('game', 'videos', 'comments', 'userPendingComments', 'relatedGames'));
    }
}
