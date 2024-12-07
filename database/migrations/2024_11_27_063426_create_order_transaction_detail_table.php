<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_transaction_detail', function (Blueprint $table) {
            $table->id('detail_ID');
            // $table->unsignedBigInteger('temp_ID')->nullable();
            // $table->unsignedBigInteger('additional_ID')->nullable();
            $table->unsignedBigInteger('menu_ID')->nullable();
            // $table->unsignedBigInteger('custom_ID')->nullable();
            $table->unsignedBigInteger('order_ID');
            $table->string('size', 255)->nullable();
            $table->decimal('price', 10, 2);
            $table->integer('quantity');
            $table->timestamps();

            // Foreign keys
            // $table->foreign('temp_ID')->references('temp_ID')->on('temp_transaction_order')->onDelete('cascade');
            // $table->foreign('additional_ID')->references('additional_ID')->on('additional_items')->onDelete('cascade');
            $table->foreign('menu_ID')->references('menu_ID')->on('menu_items')->onDelete('cascade');
            // $table->foreign('custom_ID')->references('custom_ID')->on('custom_pizza')->onDelete('cascade');
            $table->foreign('order_ID')->references('order_ID')->on('order_transaction')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_transaction_detail');
    }
};
