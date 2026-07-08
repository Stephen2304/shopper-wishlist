<?php

declare(strict_types=1);

namespace Stephen2304\ShopperWishlist\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class StoreWishlistItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, list<mixed>>
     */
    public function rules(): array
    {
        return [
            'product_id' => ['required', 'integer', Rule::exists(shopper_table('products'), 'id')],
        ];
    }
}
