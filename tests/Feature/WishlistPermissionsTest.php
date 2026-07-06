<?php

declare(strict_types=1);

use Shopper\Models\Permission;
use Stephen2304\ShopperWishlist\Database\Seeders\WishlistPermissionsSeeder;

it('declares the wishlist browse permission on the panel', function (): void {
    expect(shopper()->addonManager()->getPermissions())->toContain('wishlist.browse');
});

it('seeds the wishlist browse permission', function (): void {
    (new WishlistPermissionsSeeder)->run();

    expect(Permission::query()->where('name', 'wishlist.browse')->exists())->toBeTrue();
});
