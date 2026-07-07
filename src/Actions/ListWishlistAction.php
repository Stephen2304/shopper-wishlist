<?php

declare(strict_types=1);

namespace Stephen2304\ShopperWishlist\Actions;

use Illuminate\Database\Eloquent\Collection;
use Shopper\Models\Contracts\ShopperUser;
use Stephen2304\ShopperWishlist\Models\WishlistItem;

final class ListWishlistAction
{
    /**
     * @return Collection<int, WishlistItem>
     */
    public function __invoke(ShopperUser $customer): Collection
    {
        return WishlistItem::query()
            ->where('customer_id', $customer->id)
            ->with('product')
            ->latest()
            ->get();
    }
}
