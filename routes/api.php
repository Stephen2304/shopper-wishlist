<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stephen2304\ShopperWishlist\Http\Controllers\WishlistController;

Route::middleware(['web', 'auth:'.config('shopper.auth.guard')])
    ->prefix('api/wishlist')
    ->name('wishlist.')
    ->group(function (): void {
        Route::get('/', [WishlistController::class, 'index'])->name('index');
        Route::post('/', [WishlistController::class, 'store'])->name('store');
        Route::delete('/{product}', [WishlistController::class, 'destroy'])->name('destroy')->whereNumber('product');
    });
