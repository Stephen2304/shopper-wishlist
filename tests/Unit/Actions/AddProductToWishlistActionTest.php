<?php

declare(strict_types=1);

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Shopper\Core\Models\Product;
use Stephen2304\ShopperWishlist\Actions\AddProductToWishlistAction;
use Stephen2304\ShopperWishlist\Models\WishlistItem;
use Stephen2304\ShopperWishlist\Tests\Stubs\User;

it('creates a wishlist item for the customer and product', function (): void {
    $customer = User::factory()->create();
    $product = Product::factory()->create();

    $item = (new AddProductToWishlistAction)($customer, $product->id);

    expect($item)->toBeInstanceOf(WishlistItem::class)
        ->and($item->customer_id)->toBe($customer->id)
        ->and($item->product_id)->toBe($product->id);
});

it('returns the existing item instead of duplicating it', function (): void {
    $customer = User::factory()->create();
    $product = Product::factory()->create();

    $first = (new AddProductToWishlistAction)($customer, $product->id);
    $second = (new AddProductToWishlistAction)($customer, $product->id);

    expect($second->id)->toBe($first->id)
        ->and(WishlistItem::query()->count())->toBe(1);
});

it('throws when the product does not exist', function (): void {
    $customer = User::factory()->create();

    (new AddProductToWishlistAction)($customer, 999_999);
})->throws(ModelNotFoundException::class);
