<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Schema;

it('creates the wishlist items table with the expected columns', function (): void {
    expect(Schema::hasTable(shopper_table('wishlist_items')))->toBeTrue()
        ->and(Schema::hasColumns(shopper_table('wishlist_items'), [
            'id', 'customer_id', 'product_id', 'created_at', 'updated_at',
        ]))->toBeTrue();
});

it('rolls back the wishlist items table', function (): void {
    $migration = include __DIR__.'/../../database/migrations/create_wishlist_items_table.php';

    $migration->down();

    expect(Schema::hasTable(shopper_table('wishlist_items')))->toBeFalse();

    $migration->up();

    expect(Schema::hasTable(shopper_table('wishlist_items')))->toBeTrue();
});
