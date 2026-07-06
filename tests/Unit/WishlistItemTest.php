<?php

declare(strict_types=1);

use Illuminate\Database\QueryException;
use Shopper\Core\Models\Product;
use Stephen2304\ShopperWishlist\Models\WishlistItem;
use Stephen2304\ShopperWishlist\Tests\Stubs\User;

it('belongs to a customer and a product', function (): void {
    $item = WishlistItem::factory()->create();

    expect($item->customer)->toBeInstanceOf(User::class)
        ->and($item->product)->toBeInstanceOf(Product::class);
});

it('prevents adding the same product twice to a customer wishlist', function (): void {
    $customer = User::factory()->create();
    $product = Product::factory()->create();

    WishlistItem::query()->create([
        'customer_id' => $customer->id,
        'product_id' => $product->id,
    ]);

    WishlistItem::query()->create([
        'customer_id' => $customer->id,
        'product_id' => $product->id,
    ]);
})->throws(QueryException::class);
