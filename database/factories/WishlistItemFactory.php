<?php

declare(strict_types=1);

namespace Stephen2304\ShopperWishlist\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Shopper\Core\Database\Factories\ProductFactory;
use Stephen2304\ShopperWishlist\Models\WishlistItem;

/**
 * @extends Factory<WishlistItem>
 */
final class WishlistItemFactory extends Factory
{
    protected $model = WishlistItem::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => (config('auth.providers.users.model'))::factory(),
            'product_id' => ProductFactory::new(),
        ];
    }
}
