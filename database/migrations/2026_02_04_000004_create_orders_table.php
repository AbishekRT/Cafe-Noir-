<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration to create the orders table.
 * Stores customer orders with shipping details and payment information.
 */
return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');

            // Customer Information
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone');
            $table->text('shipping_address');
            $table->text('notes')->nullable();

            // Order Totals
            $table->decimal('subtotal', 10, 2);
            $table->decimal('tax', 10, 2)->default(0);
            $table->decimal('total', 10, 2);

            // Payment Information
            $table->enum('payment_method', ['cod', 'stripe'])->default('cod');
            $table->string('payment_status')->default('pending');
            $table->string('stripe_payment_id')->nullable();

            // Order Status
            $table->enum('status', ['pending', 'processing', 'completed', 'cancelled'])->default('pending');

            $table->timestamps();

            $table->index('order_number');
            $table->index('status');
            $table->index('payment_status');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
