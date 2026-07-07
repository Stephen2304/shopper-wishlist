<?php

declare(strict_types=1);

use Stephen2304\ShopperWishlist\Actions\ListWishlistAction;
use Stephen2304\ShopperWishlist\Models\WishlistItem;
use Stephen2304\ShopperWishlist\Tests\Stubs\User;

it('only returns wishlist items belonging to the customer', function (): void {
    $customer = User::factory()->create();
    $otherCustomer = User::factory()->create();

    $mine = WishlistItem::factory()->for($customer, 'customer')->create();
    WishlistItem::factory()->for($otherCustomer, 'customer')->create();

    $items = (new ListWishlistAction)($customer);

    expect($items)->toHaveCount(1)
        ->and($items->first()->id)->toBe($mine->id)
        ->and($items->first()->relationLoaded('product'))->toBeTrue();
});
