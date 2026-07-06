<?php

declare(strict_types=1);

use Shopper\ShopperPanel;
use Stephen2304\ShopperWishlist\WishlistAddon;

it('is registered by default', function (): void {
    $panel = new ShopperPanel;

    $panel->addon(new WishlistAddon);

    expect($panel->hasAddon('wishlist'))->toBeTrue();
});

it('can be disabled through the shopper.addons configuration', function (): void {
    config(['shopper.addons.wishlist' => false]);

    $panel = new ShopperPanel;

    $panel->addon(new WishlistAddon);

    expect($panel->hasAddon('wishlist'))->toBeFalse();
});
