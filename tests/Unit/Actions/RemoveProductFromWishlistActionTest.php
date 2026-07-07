<?php

declare(strict_types=1);

use Stephen2304\ShopperWishlist\Actions\RemoveProductFromWishlistAction;
use Stephen2304\ShopperWishlist\Models\WishlistItem;
use Stephen2304\ShopperWishlist\Tests\Stubs\User;

it('removes the matching wishlist item', function (): void {
    $customer = User::factory()->create();
    $item = WishlistItem::factory()->for($customer, 'customer')->create();

    (new RemoveProductFromWishlistAction)($customer, $item->product_id);

    expect(WishlistItem::query()->whereKey($item->id)->exists())->toBeFalse();
});

it('does not affect another customer wishlist', function (): void {
    $customer = User::factory()->create();
    $otherCustomer = User::factory()->create();
    $item = WishlistItem::factory()->for($otherCustomer, 'customer')->create();

    (new RemoveProductFromWishlistAction)($customer, $item->product_id);

    expect(WishlistItem::query()->whereKey($item->id)->exists())->toBeTrue();
});
