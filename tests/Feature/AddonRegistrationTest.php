<?php

declare(strict_types=1);

it('registers the wishlist addon on the shopper panel', function (): void {
    expect(shopper()->hasAddon('wishlist'))->toBeTrue();
});
