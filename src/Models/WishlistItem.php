<?php

declare(strict_types=1);

namespace Stephen2304\ShopperWishlist\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Stephen2304\ShopperWishlist\Database\Factories\WishlistItemFactory;

/**
 * @property-read int $id
 * @property-read int $customer_id
 * @property-read int $product_id
 */
final class WishlistItem extends Model
{
    /** @use HasFactory<WishlistItemFactory> */
    use HasFactory;

    /** @var list<string> */
    protected $fillable = ['customer_id', 'product_id'];

    public function getTable(): string
    {
        return shopper_table('wishlist_items');
    }

    /**
     * @return BelongsTo<Model, $this>
     */
    public function customer(): BelongsTo
    {
        /** @var class-string<Model> $customerModel */
        $customerModel = config('auth.providers.users.model');

        return $this->belongsTo($customerModel, 'customer_id');
    }

    /**
     * @return BelongsTo<Model, $this>
     */
    public function product(): BelongsTo
    {
        /** @var class-string<Model> $productModel */
        $productModel = config('shopper.models.product');

        return $this->belongsTo($productModel, 'product_id');
    }

    protected static function newFactory(): WishlistItemFactory
    {
        return new WishlistItemFactory;
    }
}
