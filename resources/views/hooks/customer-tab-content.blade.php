@php
    $wishlistCustomerId = request()->route('user');
    $wishlistCustomerModel = config('auth.providers.users.model');
    $wishlistCustomer = $wishlistCustomerId ? $wishlistCustomerModel::find($wishlistCustomerId) : null;
@endphp
@if ($wishlistCustomer)
    <div x-cloak x-show="currentTab === 'wishlist'">
        <livewire:shopper-wishlist.customer-tab :customer="$wishlistCustomer" :key="'wishlist-'.$wishlistCustomer->id" />
    </div>
@endif
