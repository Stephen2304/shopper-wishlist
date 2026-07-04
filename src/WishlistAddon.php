<?php

declare(strict_types=1);

namespace Stephen2304\ShopperWishlist;

use Shopper\Addon\BaseAddon;
use Shopper\ShopperPanel;

final class WishlistAddon extends BaseAddon
{
    public function getId(): string
    {
        return 'wishlist';
    }

    public function register(ShopperPanel $panel): void {}
}
