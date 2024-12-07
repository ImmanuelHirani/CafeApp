<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('menu_properties', function (Blueprint $table) {
            $table->id('property_ID');
            $table->unsignedBigInteger('menu_ID');
            $table->string('size');
            $table->decimal('price', 8, 2)->default(0); // Default price 0
            $table->boolean('is_active_properties')->default(1);
            $table->timestamps();

            $table->foreign('menu_ID')->references('menu_ID')->on('menu_items')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('menu_properties');
    }
};
