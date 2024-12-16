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
        Schema::create('custom_categories_properties', function (Blueprint $table) {
            $table->id('properties_ID');
            $table->unsignedBigInteger('categories_ID');
            $table->string('properties_name');
            $table->decimal('price', 8, 2)->default(0); // Default price 0
            $table->tinyInteger('is_active');
            $table->timestamps();

            $table->foreign('categories_ID')->references('categories_ID')->on('custom_categories_pizza')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_categories_properties');
    }
};
