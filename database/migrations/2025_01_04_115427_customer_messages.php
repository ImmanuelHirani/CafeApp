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

        Schema::create('customer_messages', function (Blueprint $table) {
            $table->id('message_ID');
            $table->unsignedBigInteger('user_ID');
            $table->string('name');
            $table->string('email');
            $table->string('messages');
            $table->timestamps();

            $table->foreign('user_ID')->references('user_ID')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_messages');
    }
};
