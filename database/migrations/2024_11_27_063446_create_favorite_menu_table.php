<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('favorite_menu', function (Blueprint $table) {
            $table->id('favorit_ID');
            $table->unsignedBigInteger('customer_ID');
            $table->unsignedBigInteger('menu_ID');
            $table->timestamps();

            // Foreign keys
            $table->foreign('customer_ID')->references('customer_ID')->on('customers')->onDelete('cascade');
            $table->foreign('menu_ID')->references('menu_ID')->on('menu_items')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('favorite_menu');
    }
};
