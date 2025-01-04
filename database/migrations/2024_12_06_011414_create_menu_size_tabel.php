<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('menus_size', function (Blueprint $table) {
            $table->id('menu_size_ID');
            $table->unsignedBigInteger('menu_ID');
            $table->string('size');
            $table->decimal('price', 8, 2)->default(0); // Default price 0
            $table->boolean('is_active_properties')->default(1);
            $table->timestamps();

            $table->foreign('menu_ID')->references('menu_ID')->on('menus')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('menus_size');
    }
};
