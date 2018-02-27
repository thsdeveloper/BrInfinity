<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInsurerProductionsTable extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('insurer_productions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('value');
            $table->string('date');

            $table->integer('production_id')->unsigned();
            $table->foreign('production_id')->references('id')->on('productions');

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
        Schema::dropIfExists('insurer_productions');
    }
}
