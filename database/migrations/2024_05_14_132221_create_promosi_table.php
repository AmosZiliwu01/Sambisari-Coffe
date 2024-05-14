<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promosi', function (Blueprint $table) {
                $table->integer('id_promosi');
                $table->string('judul_promosi', 255)->nullable(false);
                $table->text('deskripsi')->nullable();
                $table->string('image_promosi', 255)->nullable();
                $table->date('start_date')->nullable();
                $table->date('end_date')->nullable();
                $table->decimal('discount_price', 10, 2)->nullable();
                $table->boolean('active_status')->default(1);
                $table->unsignedBigInteger('product_id')->nullable();
                $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
                $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promosi');
    }
};
