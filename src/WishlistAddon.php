<?php

declare(strict_types=1);

namespace Stephen2304\ShopperWishlist;

use Shopper\Addon\BaseAddon;
use Shopper\ShopperPanel;
use Shopper\View\CustomerRenderHook;
use Stephen2304\ShopperWishlist\Livewire\CustomerWishlistTab;

final class WishlistAddon extends BaseAddon
{
    public function getId(): string
    {
        return 'wishlist';
    }

    public function register(ShopperPanel $panel): void
    {
        $panel->addonPermissions(['wishlist.browse']);

        $panel->addonLivewireComponents([
            'wishlist.customer-tab' => config('wishlist.components.customer-tab', CustomerWishlistTab::class),
        ]);

        $panel->renderHook(
            CustomerRenderHook::SHOW_TABS_END,
            fn (): string => view('shopper-wishlist::hooks.customer-tab-button')->render(),
        );

        $panel->renderHook(
            CustomerRenderHook::SHOW_CONTENT_AFTER,
            fn (): string => view('shopper-wishlist::hooks.customer-tab-content')->render(),
        );
    }
}
