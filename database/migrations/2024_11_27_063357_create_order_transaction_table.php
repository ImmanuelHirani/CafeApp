<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_transaction', function (Blueprint $table) {
            $table->id('order_ID');
            $table->unsignedBigInteger('customer_ID');
            $table->decimal('total_amount', 10, 2);
            $table->string('status_order');
            $table->timestamps();

            // Foreign key
            $table->foreign('customer_ID')->references('customer_ID')->on('customers')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_transaction');
    }
};
