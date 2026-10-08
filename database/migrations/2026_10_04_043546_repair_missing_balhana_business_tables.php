<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('products')) {
            Schema::create('products', function (Blueprint $table) {
                $table->id();
                $table->string('code')->unique();
                $table->string('name');
                $table->string('category')->nullable();
                $table->string('material')->nullable();
                $table->text('notes')->nullable();
                $table->decimal('selling_price', 15, 2)->default(0);
                $table->decimal('purchase_price', 15, 2)->default(0);
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('product_variants')) {
            Schema::create('product_variants', function (Blueprint $table) {
                $table->id();
                $table->foreignId('product_id')->constrained()->cascadeOnDelete();
                $table->string('sku')->nullable()->unique();
                $table->string('size')->default('All size');
                $table->string('color')->default('Default');
                $table->unsignedInteger('stock')->default(0);
                $table->unsignedInteger('low_stock_threshold')->default(3);
                $table->timestamps();
                $table->unique(['product_id', 'size', 'color']);
            });
        }

        if (!Schema::hasTable('market_interests')) {
            Schema::create('market_interests', function (Blueprint $table) {
                $table->id();
                $table->foreignId('product_id')->nullable()->constrained()->nullOnDelete();
                $table->date('observed_at');
                $table->string('source');
                $table->string('account_name')->nullable();
                $table->string('size')->nullable();
                $table->string('color')->nullable();
                $table->string('material')->nullable();
                $table->unsignedInteger('interested_count')->default(1);
                $table->text('notes')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('sales')) {
            Schema::create('sales', function (Blueprint $table) {
                $table->id();
                $table->string('sale_code')->unique();
                $table->date('sold_at');
                $table->string('channel')->nullable();
                $table->string('customer_name')->nullable();
                $table->foreignId('product_id')->nullable()->constrained()->nullOnDelete();
                $table->foreignId('product_variant_id')->nullable()->constrained('product_variants')->nullOnDelete();
                $table->unsignedInteger('quantity')->default(1);
                $table->decimal('unit_price', 15, 2)->default(0);
                $table->decimal('total', 15, 2)->default(0);
                $table->string('status')->default('Selesai');
                $table->text('notes')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('purchases')) {
            Schema::create('purchases', function (Blueprint $table) {
                $table->id();
                $table->string('purchase_code')->unique();
                $table->date('ordered_at');
                $table->string('supplier_name');
                $table->string('status')->default('Menunggu konfirmasi');
                $table->decimal('total', 15, 2)->default(0);
                $table->decimal('estimated_shipping', 15, 2)->default(0);
                $table->decimal('other_costs', 15, 2)->default(0);
                $table->text('notes')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('purchase_items')) {
            Schema::create('purchase_items', function (Blueprint $table) {
                $table->id();
                $table->foreignId('purchase_id')->constrained()->cascadeOnDelete();
                $table->foreignId('product_id')->nullable()->constrained()->nullOnDelete();
                $table->foreignId('product_variant_id')->nullable()->constrained('product_variants')->nullOnDelete();
                $table->unsignedInteger('quantity')->default(1);
                $table->decimal('unit_cost', 15, 2)->default(0);
                $table->decimal('subtotal', 15, 2)->default(0);
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('stock_movements')) {
            Schema::create('stock_movements', function (Blueprint $table) {
                $table->id();
                $table->foreignId('product_id')->nullable()->constrained()->nullOnDelete();
                $table->foreignId('product_variant_id')->nullable()->constrained('product_variants')->nullOnDelete();
                $table->string('movement_type');
                $table->integer('quantity');
                $table->string('reference')->nullable();
                $table->timestamp('occurred_at');
                $table->text('notes')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('financial_transactions')) {
            Schema::create('financial_transactions', function (Blueprint $table) {
                $table->id();
                $table->date('transaction_date');
                $table->string('type');
                $table->string('category')->nullable();
                $table->string('description');
                $table->decimal('amount', 15, 2)->default(0);
                $table->string('status')->default('Selesai');
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('business_settings')) {
            Schema::create('business_settings', function (Blueprint $table) {
                $table->id();
                $table->string('setting_key')->unique();
                $table->text('setting_value')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        // Dibiarkan kosong agar rollback tidak menghapus tabel atau data yang sudah ada.
    }
};