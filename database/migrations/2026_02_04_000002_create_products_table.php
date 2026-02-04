<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration to create the products table.
 * Stores all coffee products with pricing, stock, and categorization.
 */
return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('sku')->unique();
            $table->text('description');
            $table->text('short_description')->nullable();
            $table->decimal('price', 10, 2);
            $table->decimal('compare_price', 10, 2)->nullable();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');

            // Product details
            $table->string('weight')->nullable();
            $table->string('roast_level')->nullable();
            $table->string('origin')->nullable();
            $table->integer('stock_quantity')->nullable()->comment('Null means unlimited stock');

            // Status flags
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);

            // SEO fields
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();

            $table->timestamps();

            $table->index('is_active');
            $table->index('is_featured');
            $table->index('price');
            $table->index('created_at');
            $table->fullText(['name', 'description']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
