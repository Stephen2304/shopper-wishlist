<?php

declare(strict_types=1);

namespace Stephen2304\ShopperWishlist\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Shopper\Models\Contracts\ShopperUser;
use Stephen2304\ShopperWishlist\Actions\AddProductToWishlistAction;
use Stephen2304\ShopperWishlist\Actions\ListWishlistAction;
use Stephen2304\ShopperWishlist\Actions\RemoveProductFromWishlistAction;
use Stephen2304\ShopperWishlist\Http\Requests\StoreWishlistItemRequest;
use Stephen2304\ShopperWishlist\Http\Resources\WishlistItemResource;

final class WishlistController extends Controller
{
    public function index(Request $request, ListWishlistAction $action): AnonymousResourceCollection
    {
        /** @var ShopperUser $customer */
        $customer = $request->user();

        return WishlistItemResource::collection($action($customer));
    }

    public function store(StoreWishlistItemRequest $request, AddProductToWishlistAction $action): JsonResponse
    {
        /** @var ShopperUser $customer */
        $customer = $request->user();

        /** @var int $productId */
        $productId = $request->validated('product_id');

        return WishlistItemResource::make($action($customer, $productId))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function destroy(Request $request, int $product, RemoveProductFromWishlistAction $action): Response
    {
        /** @var ShopperUser $customer */
        $customer = $request->user();

        $action($customer, $product);

        return response()->noContent();
    }
}
