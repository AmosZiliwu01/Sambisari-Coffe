<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedbacksTable extends Migration
{
/**
* Run the migrations.
*
* @return void
*/
public function up()
{
Schema::create('feedbacks', function (Blueprint $table) {
$table->increments('id'); // Menggunakan increments untuk auto-increment primary key
$table->string('nama');
$table->string('content');
$table->string('rating');
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
Schema::dropIfExists('feedbacks');
}
}
