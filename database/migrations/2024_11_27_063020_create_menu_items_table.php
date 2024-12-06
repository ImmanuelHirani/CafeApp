<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id('menu_ID'); // Primary key dengan auto_increment
            $table->string('menu_type'); // Jenis menu
            $table->string('image')->nullable(); // Gambar menu, nullable
            $table->string('name'); // Nama menu
            $table->integer('stock')->nullable(); // Stok menu, nullable
            $table->text('menu_description')->nullable(); // Deskripsi menu, nullable
            $table->boolean('is_active')->default(true); // Status aktif sebagai boolean
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menu_items'); // Menghapus tabel saat rollback
    }
};
