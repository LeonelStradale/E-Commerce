<?php

use App\Http\Controllers\AuthSocialiteController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\WelcomeController;
use Gloudemans\Shoppingcart\Facades\Cart;
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

Route::get('/', [WelcomeController::class, 'index'])->name('welcome.index');

Route::get('families/{family}', [FamilyController::class, 'show'])->name('families.show');

Route::get('categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

Route::get('subcategories/{subcategory}', [SubcategoryController::class, 'show'])->name('subcategories.show');

Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');

Route::get('cart', [CartController::class, 'index'])->name('cart.index');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('test', function () {
    Cart::instance('shopping');

    return Cart::content();
});

/* Google Auth */
Route::get('/google-auth/redirect', [AuthSocialiteController::class, 'redirectGoogle'])
    ->name('google-auth.redirect');

Route::get('/google-auth/callback', [AuthSocialiteController::class, 'callbackGoogle'])
    ->name('google-auth.callback');

/* Facebook Auth */
Route::get('/facebook-auth/redirect', [AuthSocialiteController::class, 'redirectFacebook'])
    ->name('facebook-auth.redirect');

Route::get('/facebook-auth/callback', [AuthSocialiteController::class, 'callbackFacebook'])
    ->name('facebook-auth.callback');

Route::match(['get', 'post'], '/botman', 'App\Http\Controllers\BotManController@handle');
