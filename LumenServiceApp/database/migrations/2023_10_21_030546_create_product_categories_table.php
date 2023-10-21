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
        Schema::create('product_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100);
            $table->text('description')->nullable();
            $table->string('slug', 100)->unique(); // Kolom slug dengan atribut unique
            $table->integer('parent_id')->nullable(); // Kolom untuk menunjukkan kategori induk
            $table->string('image_path')->nullable(); // Kolom untuk path gambar
            $table->boolean('active')->default(true); // Kolom boolean aktif
            $table->timestamps(); // Kolom created_at dan updated_at otomatis
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_categories');
    }
};
