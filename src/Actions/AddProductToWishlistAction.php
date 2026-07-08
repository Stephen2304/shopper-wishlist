<?php

declare(strict_types=1);

namespace Stephen2304\ShopperWishlist\Actions;

use Shopper\Core\Models\Product;
use Shopper\Models\Contracts\ShopperUser;
use Stephen2304\ShopperWishlist\Models\WishlistItem;

final class AddProductToWishlistAction
{
    public function __invoke(ShopperUser $customer, int $productId): WishlistItem
    {
        /** @var class-string<Product> $productModel */
        $productModel = config('shopper.models.product');

        $productModel::query()->findOrFail($productId);

        return WishlistItem::query()->firstOrCreate([
            'customer_id' => $customer->id,
            'product_id' => $productId,
        ]);
    }
}
