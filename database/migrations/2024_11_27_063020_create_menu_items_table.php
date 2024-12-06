<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id('menu_ID');
            $table->string('menu_type');
            $table->string('image')->nullable();
            $table->string('name');
            $table->integer('stock')->nullable();
            $table->text('menu_description')->nullable();
            $table->integer('is_active', 4)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menu_items');
    }
};
