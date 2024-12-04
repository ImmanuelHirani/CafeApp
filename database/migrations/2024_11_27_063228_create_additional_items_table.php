<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('additional_items', function (Blueprint $table) {
            $table->id('additional_ID');
            $table->unsignedBigInteger('menu_ID');
            $table->string('size');
            $table->string('extra');
            $table->decimal('additional_price', 10, 2);
            $table->timestamps();

            // Foreign key
            $table->foreign('menu_ID')->references('menu_ID')->on('menu_items')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('additional_items');
    }
};
