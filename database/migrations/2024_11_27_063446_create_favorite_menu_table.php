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
            $table->unsignedBigInteger('user_ID');
            $table->unsignedBigInteger('menu_ID');
            $table->timestamps();
            // Foreign keys
            $table->foreign('user_ID')->references('user_ID')->on('users')->onDelete('cascade');
            $table->foreign('menu_ID')->references('menu_ID')->on('menus')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('favorite_menu');
    }
};
