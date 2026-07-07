<?php

declare(strict_types=1);

namespace Stephen2304\ShopperWishlist\Actions;

use Shopper\Models\Contracts\ShopperUser;
use Stephen2304\ShopperWishlist\Models\WishlistItem;

final class RemoveProductFromWishlistAction
{
    public function __invoke(ShopperUser $customer, int $productId): void
    {
        WishlistItem::query()
            ->where('customer_id', $customer->id)
            ->where('product_id', $productId)
            ->delete();
    }
}
