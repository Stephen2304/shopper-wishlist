<?php

declare(strict_types=1);

namespace Stephen2304\ShopperWishlist\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Shopper\Core\Models\Product;

/**
 * @property-read int $id
 * @property-read int $product_id
 * @property-read Product $product
 * @property-read \Illuminate\Support\Carbon $created_at
 */
final class WishlistItemResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'product_id' => $this->product_id,
            'product' => [
                'id' => $this->product->id,
                'name' => $this->product->name,
                'slug' => $this->product->slug,
            ],
            'created_at' => $this->created_at,
        ];
    }
}
