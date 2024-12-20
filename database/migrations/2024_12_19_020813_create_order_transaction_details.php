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
        Schema::create('order_transaction_details', function (Blueprint $table) {
            $table->id('order_detail_ID');
            $table->unsignedBigInteger('order_ID');
            $table->unsignedBigInteger('menu_ID');
            $table->string('size');
            $table->string('menu_name');
            $table->integer('quantity');
            $table->decimal('subtotal', 10);
            $table->timestamps();

            $table->foreign('menu_ID')->references('menu_ID')->on('menu_items')->onDelete('cascade');
            $table->foreign('order_ID')->references('order_ID')->on('order_transaction')->onDelete('cascade');
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temp_order_transaction_details');
    }
};
