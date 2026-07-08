<?php

declare(strict_types=1);

namespace Stephen2304\ShopperWishlist\Livewire;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Shopper\Models\Contracts\ShopperUser;
use Stephen2304\ShopperWishlist\Actions\ListWishlistAction;
use Stephen2304\ShopperWishlist\Models\WishlistItem;

/**
 * @property-read Collection<int, WishlistItem> $items
 */
class CustomerWishlistTab extends Component
{
    /** @var Model&ShopperUser */
    #[Locked]
    public ShopperUser $customer;

    /**
     * @return Collection<int, WishlistItem>
     */
    #[Computed]
    public function items(): Collection
    {
        return app(ListWishlistAction::class)($this->customer);
    }

    public function render(): View
    {
        return view('shopper-wishlist::livewire.customer-wishlist-tab');
    }
}
