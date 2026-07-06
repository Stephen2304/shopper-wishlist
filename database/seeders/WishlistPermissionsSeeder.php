<?php

declare(strict_types=1);

namespace Stephen2304\ShopperWishlist\Database\Seeders;

use Illuminate\Database\Seeder;
use Shopper\Models\Permission;

final class WishlistPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        Permission::query()->firstOrCreate([
            'name' => 'wishlist.browse',
        ], [
            'group_name' => 'customers',
            'display_name' => __('shopper-wishlist::permissions.browse.display_name'),
            'description' => __('shopper-wishlist::permissions.browse.description'),
            'can_be_removed' => false,
        ]);
    }
}
