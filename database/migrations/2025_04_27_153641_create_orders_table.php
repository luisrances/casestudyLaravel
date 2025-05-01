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
            $table->unsignedBigInteger('product_id'); // Foreign key
            $table->unsignedBigInteger('customer_id'); // Foreign key
            $table->integer('quantity')->default(1);
            $table->enum('order_status', [
                'to pay',
                'to ship',
                'to receive',
                'completed',
                'refund',
                'cancelled'
            ])->default('to pay');
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
