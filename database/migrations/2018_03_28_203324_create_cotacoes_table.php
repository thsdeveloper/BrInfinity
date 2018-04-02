<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCotacoesTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('cotacoes', function (Blueprint $table) {
      $table->increments('id');

      //Insert inicial
      $table->date('data_solicitacao');
      $table->string('proponent');
      $table->string('cpf');
      $table->string('ramo');
      $table->text('descricao');
      $table->string('negocio');
      $table->string('valor');

      //Update status
      $table->integer('status')->nullable();
      $table->text('text_status')->nullable();

      //Update
      $table->date('data_validade')->nullable();
      $table->string('congenere')->nullable();
      $table->string('last_valor')->nullable();
      $table->string('comissao')->nullable();
      $table->string('arquivo')->nullable();

      //Relacionamentos
      $table->integer('seguradora_id')->unsigned();
      $table->foreign('seguradora_id')->references('id')->on('seguradoras');
      $table->integer('corretora_id')->unsigned();
      $table->foreign('corretora_id')->references('id')->on('corretoras');
      $table->integer('user_id')->unsigned();
      $table->foreign('user_id')->references('id')->on('users');

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
    Schema::dropIfExists('cotacoes');
  }
}
