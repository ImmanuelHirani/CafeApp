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

        Schema::create('transaction_location', function (Blueprint $table) {
            $table->id('transaction_location_ID');
            $table->unsignedBigInteger('transaction_ID');
            $table->string('location_label');
            $table->string('reciver_address');
            $table->string('reciver_number');
            $table->string('reciver_name');
            $table->timestamps();

            $table->foreign('transaction_ID')->references('transaction_ID')->on('transaction')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_location');
    }
};
