<?php

declare(strict_types=1);

use Livewire\Livewire;
use Stephen2304\ShopperWishlist\Livewire\CustomerWishlistTab;
use Stephen2304\ShopperWishlist\Models\WishlistItem;
use Stephen2304\ShopperWishlist\Tests\Stubs\User;

it('shows an empty state when the customer has no wishlist items', function (): void {
    $customer = User::factory()->create();

    Livewire::test(CustomerWishlistTab::class, ['customer' => $customer])
        ->assertSee(__('shopper-wishlist::messages.empty_title'));
});

it('lists the customer wishlist items', function (): void {
    $customer = User::factory()->create();
    $item = WishlistItem::factory()->for($customer, 'customer')->create();

    Livewire::test(CustomerWishlistTab::class, ['customer' => $customer])
        ->assertSee($item->product->name);
});
