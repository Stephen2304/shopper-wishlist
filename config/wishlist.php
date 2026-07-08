<?php

declare(strict_types=1);

use Stephen2304\ShopperWishlist\Livewire\CustomerWishlistTab;

return [

    /*
    |--------------------------------------------------------------------------
    | Livewire Components
    |--------------------------------------------------------------------------
    |
    | Override any of these components in your own application by publishing
    | this config file and pointing the key to your own class extending
    | the base component.
    |
    */

    'components' => [
        'customer-tab' => CustomerWishlistTab::class,
    ],

];
