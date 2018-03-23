<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductionsTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('productions', function (Blueprint $table) {
      $table->increments('id');

      $table->integer('user_id')->unsigned();
      $table->integer('corretora_id')->unsigned();
      $table->integer('seguradora_id')->unsigned();

      $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
      $table->foreign('corretora_id')->references('id')->on('corretoras')->onDelete('cascade');
      $table->foreign('seguradora_id')->references('id')->on('seguradoras')->onDelete('cascade');

        $table->string('valor');

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
    Schema::dropIfExists('productions');
  }
}
