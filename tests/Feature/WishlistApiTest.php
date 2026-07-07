<?php

declare(strict_types=1);

use Shopper\Core\Models\Product;
use Stephen2304\ShopperWishlist\Models\WishlistItem;
use Stephen2304\ShopperWishlist\Tests\Stubs\User;

it('rejects unauthenticated requests', function (): void {
    $this->getJson(route('wishlist.index'))->assertUnauthorized();
});

it('lists only the authenticated customer wishlist', function (): void {
    $customer = $this->asCustomer();
    $otherCustomer = User::factory()->create();

    $mine = WishlistItem::factory()->for($customer, 'customer')->create();
    WishlistItem::factory()->for($otherCustomer, 'customer')->create();

    $this->getJson(route('wishlist.index'))
        ->assertOk()
        ->assertJsonCount(1, 'data')
        ->assertJsonPath('data.0.id', $mine->id);
});

it('adds a product to the wishlist', function (): void {
    $this->asCustomer();
    $product = Product::factory()->create();

    $this->postJson(route('wishlist.store'), ['product_id' => $product->id])
        ->assertCreated()
        ->assertJsonPath('data.product_id', $product->id);

    expect(WishlistItem::query()->where('product_id', $product->id)->exists())->toBeTrue();
});

it('does not duplicate a product already in the wishlist', function (): void {
    $customer = $this->asCustomer();
    $product = Product::factory()->create();

    WishlistItem::factory()->for($customer, 'customer')->for($product, 'product')->create();

    $this->postJson(route('wishlist.store'), ['product_id' => $product->id])->assertCreated();

    expect(WishlistItem::query()->where('product_id', $product->id)->count())->toBe(1);
});

it('rejects an unknown product id', function (): void {
    $this->asCustomer();

    $this->postJson(route('wishlist.store'), ['product_id' => 999_999])
        ->assertUnprocessable()
        ->assertJsonValidationErrors('product_id');
});

it('removes a product from the wishlist', function (): void {
    $customer = $this->asCustomer();
    $item = WishlistItem::factory()->for($customer, 'customer')->create();

    $this->deleteJson(route('wishlist.destroy', ['product' => $item->product_id]))
        ->assertNoContent();

    expect(WishlistItem::query()->whereKey($item->id)->exists())->toBeFalse();
});

it('is idempotent when removing a product not in the wishlist', function (): void {
    $this->asCustomer();

    $this->deleteJson(route('wishlist.destroy', ['product' => 999_999]))
        ->assertNoContent();
});
