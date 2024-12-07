<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('temp_transaction_order', function (Blueprint $table) {
            $table->id('temp_ID');
            $table->unsignedBigInteger('menu_ID');
            $table->unsignedBigInteger('customer_ID');
            $table->string('size');
            $table->integer('quantity');
            $table->decimal('subtotal', 10, 2);
            $table->timestamps();

            $table->foreign('menu_ID')->references('menu_ID')->on('menu_items')->onDelete('cascade');
            $table->foreign('customer_ID')->references('customer_ID')->on('customers')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('temp_transaction_order');
    }
};
