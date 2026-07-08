<div class="space-y-4">
    @if ($this->items->isEmpty())
        <x-shopper::card>
            <x-shopper::empty-card
                icon="untitledui-heart"
                :heading="__('shopper-wishlist::messages.empty_title')"
                :description="__('shopper-wishlist::messages.empty_description')"
            />
        </x-shopper::card>
    @else
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($this->items as $item)
                <x-shopper::card class="[&>div:first-of-type]:p-4">
                    <p class="text-sh-fg font-medium">{{ $item->product->name }}</p>
                    <p class="text-sh-fg-secondary mt-1 text-sm">
                        {{ __('shopper-wishlist::messages.added_at', ['time' => $item->created_at->diffForHumans()]) }}
                    </p>
                </x-shopper::card>
            @endforeach
        </div>
    @endif
</div>
