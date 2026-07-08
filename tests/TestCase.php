<?php

declare(strict_types=1);

namespace Stephen2304\ShopperWishlist\Tests;

use BladeUI\Heroicons\BladeHeroiconsServiceProvider;
use BladeUI\Icons\BladeIconsServiceProvider;
use Codeat3\BladePhosphorIcons\BladePhosphorIconsServiceProvider;
use CodeWithDennis\FilamentSelectTree\FilamentSelectTreeServiceProvider;
use Filament\Actions\ActionsServiceProvider;
use Filament\FilamentServiceProvider;
use Filament\Forms\FormsServiceProvider;
use Filament\Infolists\InfolistsServiceProvider;
use Filament\Notifications\NotificationsServiceProvider;
use Filament\Schemas\SchemasServiceProvider;
use Filament\Support\Livewire\Partials\DataStoreOverride;
use Filament\Support\SupportServiceProvider;
use Filament\Tables\TablesServiceProvider;
use Filament\Widgets\WidgetsServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\ViewErrorBag;
use JaOcero\RadioDeck\RadioDeckServiceProvider;
use Laravelcm\LivewireSlideOvers\LivewireSlideOverServiceProvider;
use Livewire\LivewireServiceProvider;
use Livewire\Mechanisms\DataStore;
use Mckenziearts\BladeUntitledUIIcons\BladeUntitledUIIconsServiceProvider;
use Milon\Barcode\BarcodeServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;
use Shopper\Cart\CartServiceProvider;
use Shopper\Core\CoreServiceProvider;
use Shopper\Payment\PaymentServiceProvider;
use Shopper\Shipping\ShippingServiceProvider;
use Shopper\ShopperServiceProvider;
use Shopper\Sidebar\SidebarServiceProvider;
use Spatie\MediaLibrary\MediaLibraryServiceProvider;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Spatie\Permission\PermissionServiceProvider;
use Stephen2304\ShopperWishlist\ShopperWishlistServiceProvider;
use Stephen2304\ShopperWishlist\Tests\Stubs\User;
use TailwindMerge\Laravel\TailwindMergeServiceProvider;

abstract class TestCase extends BaseTestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->app->make(PermissionRegistrar::class)->forgetCachedPermissions();

        $this->app['view']->share('errors', new ViewErrorBag);

        $this->app->singleton(DataStore::class, DataStoreOverride::class);
    }

    /**
     * @return array<int, class-string>
     */
    protected function getPackageProviders($app): array
    {
        return [
            LivewireServiceProvider::class,
            ActionsServiceProvider::class,
            BarcodeServiceProvider::class,
            BladeHeroiconsServiceProvider::class,
            BladeUntitledUIIconsServiceProvider::class,
            BladePhosphorIconsServiceProvider::class,
            BladeIconsServiceProvider::class,
            CartServiceProvider::class,
            CoreServiceProvider::class,
            FilamentServiceProvider::class,
            PaymentServiceProvider::class,
            PermissionServiceProvider::class,
            ShippingServiceProvider::class,
            ShopperServiceProvider::class,
            SidebarServiceProvider::class,
            FormsServiceProvider::class,
            InfolistsServiceProvider::class,
            SchemasServiceProvider::class,
            SupportServiceProvider::class,
            NotificationsServiceProvider::class,
            TablesServiceProvider::class,
            WidgetsServiceProvider::class,
            MediaLibraryServiceProvider::class,
            TailwindMergeServiceProvider::class,
            RadioDeckServiceProvider::class,
            FilamentSelectTreeServiceProvider::class,
            LivewireSlideOverServiceProvider::class,
            ShopperWishlistServiceProvider::class,
        ];
    }

    protected function defineEnvironment($app): void
    {
        $app['config']->set('auth.providers.users.model', User::class);

        $app['config']->set('database.default', 'testing');
        $app['config']->set('database.connections.testing', [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'shopper_wishlist_testing'),
            'username' => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', 'root'),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
        ]);
    }

    protected function defineDatabaseMigrations(): void
    {
        $this->app->afterResolving('migrator', function ($migrator): void {
            $migrator->path(__DIR__.'/database/migrations');
        });
    }

    protected function asCustomer(): User
    {
        $customer = User::factory()->create();

        Role::query()->firstOrCreate([
            'name' => config('shopper.admin.roles.user'),
            'guard_name' => config('shopper.auth.guard'),
        ]);

        $customer->assignRole(config('shopper.admin.roles.user'));

        $this->actingAs($customer, config('shopper.auth.guard'));

        return $customer;
    }
}
