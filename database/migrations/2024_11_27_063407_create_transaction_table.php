<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('transaction', function (Blueprint $table) {
            $table->id('transaction_ID');
            $table->unsignedBigInteger('user_ID');
            $table->decimal('total_amounts', 10);
            $table->string('status_order')->nullable()->default(0);
            $table->timestamps();
            $table->foreign('user_ID')->references('user_ID')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaction');
    }
};
