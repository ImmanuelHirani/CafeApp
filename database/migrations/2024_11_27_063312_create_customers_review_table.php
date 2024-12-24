<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customers_menu_review', function (Blueprint $table) {
            $table->id('review_ID');
            $table->unsignedBigInteger('customer_ID');
            $table->unsignedBigInteger('menu_ID');
            $table->integer('rating');
            $table->text('review_desc')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('customer_ID')->references('customer_ID')->on('customers')->onDelete('cascade');
            $table->foreign('menu_ID')->references('menu_ID')->on('menu_items')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customers_review');
    }
};
