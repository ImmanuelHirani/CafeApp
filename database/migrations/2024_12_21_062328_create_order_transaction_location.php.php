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

        Schema::create('order_transaction_location', function (Blueprint $table) {
            $table->id('order_transaction_location_ID');
            $table->unsignedBigInteger('order_ID');
            $table->string('location_label');
            $table->string('reciver_address');
            $table->string('reciver_number');
            $table->string('reciver_name');
            $table->timestamps();

            $table->foreign('order_ID')->references('order_ID')->on('order_transaction')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_transaction_location');
    }
};
