<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->longText('customer_address');
            $table->string('customer_whatsapp');
            $table->string('receipt');
            $table->string('shipping_receipt')->nullable();
            $table->enum('status', ['Pending', 'Paid', 'Processing', 'Shipped', 'Delivered']);
            $table->integer('total');
            $table->timestamp('paid_date')->nullable();
            $table->timestamps();
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
