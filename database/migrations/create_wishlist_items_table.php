<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Shopper\Core\Helpers\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create($this->getTableName('wishlist_items'), function (Blueprint $table): void {
            $this->addCommonFields($table);

            $this->addForeignKey($table, 'customer_id', 'users', false);
            $this->addForeignKey($table, 'product_id', $this->getTableName('products'), false);

            $table->unique(['customer_id', 'product_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->getTableName('wishlist_items'));
    }
};
