<?php

declare(strict_types=1);

namespace Stephen2304\ShopperWishlist;

use Shopper\ShopperPanel;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

final class ShopperWishlistServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('shopper-wishlist')
            ->hasTranslations()
            ->hasViews()
            ->hasConfigFile('wishlist')
            ->hasMigration('create_wishlist_items_table')
            ->runsMigrations();
    }

    public function packageRegistered(): void
    {
        $this->app->afterResolving('shopper', function (ShopperPanel $panel): void {
            $panel->addon(new WishlistAddon);
        });
    }

    public function packageBooted(): void
    {
        if (shopper()->hasAddon('wishlist')) {
            $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
        }
    }
}
