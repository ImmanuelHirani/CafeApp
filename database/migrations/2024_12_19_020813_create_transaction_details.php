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
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->id('transaction_detail_ID');
            $table->unsignedBigInteger('transaction_ID');
            $table->string('order_type');
            $table->bigInteger('menu_ID');
            $table->string('size');
            $table->string('menu_name');
            $table->integer('quantity');
            $table->decimal('subtotal', 10);
            $table->timestamps();

            $table->foreign('transaction_ID')->references('transaction_ID')->on('transaction')->onDelete('cascade');
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_details');
    }
};
