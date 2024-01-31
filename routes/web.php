<?php

use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\Content\CategoryController;
use App\Http\Controllers\Content\CommentController;
use App\Http\Controllers\Content\PostController;
use App\Http\Controllers\GameNet\GameController;
use App\Http\Controllers\Home\AboutUsController;
use App\Http\Controllers\Home\FaqController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Home\PageController;
use App\Http\Controllers\Home\SearchController;
use App\Http\Controllers\Home\SitemapController;
use App\Http\Controllers\Home\SlideshowController;
use App\Http\Controllers\Home\TaxonomyController;
use App\Http\Controllers\Shop\CartItemController;
use App\Http\Controllers\Shop\Payment\PaymentController;
use App\Http\Controllers\Shop\Payment\VerifyPaymentController;
use App\Http\Controllers\Shop\Product\ProductController;
use App\Http\Controllers\Support\ContactUsController;
use App\Http\Controllers\User\ProfileController;
use App\Livewire\PostShow;
use App\Livewire\ShowSearchResult;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role:super admin|admin|writer|seller',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// https://gpgaming.ir/_manual-sign-in?email=superadmin@gp.com&password=password
Route::get('_manual-sign-in', function () {
    if (request()->has('email') && request()->has('password')) {
        auth()->attempt([
            'email'    => request()->email,
            'password' => request()->password
        ]);
        return to_route('home');
    } else abort(404);
});

Route::group(['middleware' => 'HtmlMinifier'], function () {
    Route::middleware('guest')->group(function () {
        Route::controller(AuthenticationController::class)->group(function () {
            // authentication form
            Route::get('login-register', 'authenticationForm')->name('auth.authentication-form');

            // authentication confirm form
            Route::get('login-confirm/{token}', 'authenticationConfirmForm')->name('auth.authentication-confirm-form');

            // register form
            Route::get('register-profile/{token}', 'registerForm')->name('auth.register-form');

            // guarded by authentication rate limiter
            // Route::middleware('throttle:authentication-limiter')->group(function () {
            Route::middleware([])->group(function () {
                Route::post('authenticate', 'authenticate')->name('auth.authenticate');
                Route::post('register/{user}', 'register')->name('auth.register');
                Route::post('confirmation/{token}', 'confirmation')->name('auth.confirmation');
                Route::get('resend-otp/{token}', 'resendOtp')->name('auth.resend-otp');
            });
        });
    });

    // Home
    Route::get('/', HomeController::class)->name('home');
    Route::get('/faq', FaqController::class)->name('faq');
    Route::get('/about-us', AboutUsController::class)->name('about-us');

    // Support
    Route::name('support')
        ->group(function () {
            Route::controller(ContactUsController::class)
                ->prefix('contact-us')
                ->name('.contact-us')->group(function () {
                    Route::get('/', 'index')->name('');
                    Route::post('/store', 'store')->middleware('auth')->name('.store');
                });
        });

    // Content
    Route::name('content')
        ->group(function () {

            // Post
            Route::get('posts', [PostController::class, 'index'])->name('.posts');
            Route::get('posts/{post:slug}', PostShow::class)->name('.posts.show');

            // Comment
            Route::controller(CommentController::class)->middleware('auth')->group(function () {
                Route::post('comment', 'store')->name('.comment.store');
                Route::post('comment/reply/{comment}', 'reply')->name('.comment.reply');
            });
        });

    // Game Net
    Route::name('game-net')
        ->group(function () {

            // Game
            Route::controller(GameController::class)->group(function () {
                Route::get('games', 'index')->name('.games');
                Route::get('games/{game:slug}', 'show')->name('.games.show');
            });

        });

    // Shop
    Route::name('shop')
        ->group(function () {

            // Product
            Route::controller(ProductController::class)->group(function () {
                Route::get('products', 'index')->name('.products');
                Route::get('products/{product:slug}', 'show')->name('.products.show');
            });

            // Cart
            Route::controller(CartItemController::class)->group(function () {
                Route::get('cart', 'index')->name('.cart');
                Route::post('cart/{game}', 'addToCart')->middleware('auth')->name('.cart.add');
                Route::post('cart-product/{product}', 'productAddToCart')->middleware('auth')->name('.cart.product-add');
                Route::get('remove/{item}', 'removeFromCart')->middleware('auth')->name('.cart.remove');
                Route::middleware(['auth', 'profile-completion'])->group(function () {
                    Route::get('cart/address-and-delivery', 'addressAndDelivery')->name('.cart.address-and-delivery');
                    Route::post('cart/address-and-delivery/{totalPrice}', 'chooseAddressAndDelivery')->name('.cart.address-and-delivery.store');
                });
            });
        });

    Route::middleware('auth')->name('user')->group(function () {
        Route::get('profile', [ProfileController::class, 'index'])->name('.profile');
    });

    Route::middleware(['auth', 'profile-completion'])->prefix('payment')
        ->name('payment')->group(function () {
            Route::get('/{order}', [PaymentController::class, 'submit'])->name('.submit');

            // verify payment callback url
            Route::controller(VerifyPaymentController::class)
                ->name('.callback')->group(function () {
                    Route::get("payment/callback", 'verify')->name('.verify');
                    Route::get("payment/callback/success/{order}", 'success')->name('.success');
                    Route::get("payment/callback/failed/{order}", 'failed')->name('.failed');
                });
        });

    Route::get('search', ShowSearchResult::class)->name('show-search-result');
    Route::post('search', SearchController::class)->name('search');

    Route::get('group/{typeof}/{id}', [TaxonomyController::class, 'index'])->name('taxonomy');
    Route::get('category/{category:slug}', [CategoryController::class, 'show'])->name('category.show');
    Route::get('slides/{slide:url}', [SlideshowController::class, 'index'])->name('slides');
    Route::get('pages/{page:slug}', PageController::class)->name('pages');
});

Route::middleware(['auth', 'role:super admin|admin|writer|seller'])->get('generate-sitemap', [SitemapController::class, 'index']);
Route::get('sitemap', [SitemapController::class, 'show']);

Route::fallback(fn() => view('errors.home-404'));


