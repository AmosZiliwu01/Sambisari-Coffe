<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('barcode');
            $table->longText('isi_product');
            $table->string('name');
            $table->string('gambar_product');
            $table->integer('id_kategori');
            $table->foreign('id_kategori')->references('id_kategori')->on('kategori');
            $table->decimal('price', 20, 0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
