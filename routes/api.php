<?php

use App\Http\Controllers\Api\GameNet\GameController;
use App\Http\Controllers\Api\Shop\Product\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    Route::resource('products', ProductController::class)->only('index');
    Route::get('torob/products', [ProductController::class, 'torobIndex']);

    Route::resource('games', GameController::class)->only('index');
    Route::get('torob/games', [GameController::class, 'torobIndex']);
});


