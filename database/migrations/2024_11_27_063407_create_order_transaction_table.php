<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('order_transaction', function (Blueprint $table) {
            $table->id('order_ID');
            $table->string('order_type');
            $table->unsignedBigInteger('customer_ID');
            $table->decimal('total_amounts', 10);
            $table->string('status_order')->nullable()->default(0);
            $table->timestamps();
            $table->foreign('customer_ID')->references('customer_ID')->on('customers')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_transaction');
    }
};
