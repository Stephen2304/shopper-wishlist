<?php

declare(strict_types=1);

namespace Stephen2304\ShopperWishlist\Tests\Stubs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Shopper\Models\Contracts\ShopperUser;
use Shopper\Traits\InteractsWithShopper;

final class User extends Authenticatable implements ShopperUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory;

    use InteractsWithShopper;

    /** @var list<string> */
    protected $fillable = ['first_name', 'last_name', 'email', 'password'];

    /** @var list<string> */
    protected $hidden = ['password', 'remember_token'];

    protected static function newFactory(): UserFactory
    {
        return new UserFactory;
    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
