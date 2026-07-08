<?php

declare(strict_types=1);

use Shopper\ShopperPanel;
use Shopper\View\CustomerRenderHook;
use Stephen2304\ShopperWishlist\Livewire\CustomerWishlistTab;
use Stephen2304\ShopperWishlist\WishlistAddon;

final class FakeCustomerWishlistTab extends CustomerWishlistTab {}

it('adds a tab button to the customer show page', function (): void {
    $panel = new ShopperPanel;
    $panel->addon(new WishlistAddon);

    expect((string) $panel->getRenderHook(CustomerRenderHook::SHOW_TABS_END))
        ->toContain(__('shopper-wishlist::messages.tab_label'));
});

it('registers the default customer-tab component', function (): void {
    $panel = new ShopperPanel;
    $panel->addon(new WishlistAddon);

    expect($panel->addonManager()->getLivewireComponents())
        ->toHaveKey('wishlist.customer-tab', CustomerWishlistTab::class);
});

it('lets the host application override the customer-tab component', function (): void {
    config(['wishlist.components.customer-tab' => FakeCustomerWishlistTab::class]);

    $panel = new ShopperPanel;
    $panel->addon(new WishlistAddon);

    expect($panel->addonManager()->getLivewireComponents())
        ->toHaveKey('wishlist.customer-tab', FakeCustomerWishlistTab::class);
});
