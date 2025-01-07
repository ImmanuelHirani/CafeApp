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

        Schema::create('menu_review', function (Blueprint $table) {
            $table->id('review_ID');
            $table->unsignedBigInteger('user_ID');
            $table->unsignedBigInteger('menu_ID');
            $table->string('rating');
            $table->string('review_desc');
            $table->timestamps();

            $table->foreign('user_ID')->references('user_ID')->on('users')->onDelete('cascade');
            $table->foreign('menu_ID')->references('menu_ID')->on('menus')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_review');
    }
};
