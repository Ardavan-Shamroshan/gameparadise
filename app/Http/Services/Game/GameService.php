<?php

namespace App\Http\Services\Game;

use App\Http\Resources\GameNet\GameResource;
use App\Http\Resources\GameNet\TorobGameResource;
use App\Models\GameNet\Game;
use App\Support\Traits\JsonResponseHandler;
use Illuminate\Http\JsonResponse;

class GameService
{
    use JsonResponseHandler;

    public function indexGames(): JsonResponse
    {
        $games = GameResource::collection(Game::all());
        return $this->success(compact('games'));
    }


    /**
     محصولات در صفحه‌ی موردنظر، به ترتیب جدید به قدیم مرتب شوند. *
     یعنی محصولات جدیدا اضافه شده و جدیدا ویرایش شده در اولویت قرار داشته باشند. *
     *
     * @return JsonResponse
     */
    public function torobIndexGames(): JsonResponse
    {
        $games = TorobGameResource::collection(Game::query()->orderByDesc('created_at')->get());
        return $this->success(compact('games'));
    }
}