<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnnualReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('annual_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('seguradora_id')->unsigned();
            $table->foreign('seguradora_id')->references('id')->on('seguradoras');
            $table->string('jan')->default('0')->nullable();
            $table->string('fev')->default('0')->nullable();
            $table->string('mar')->default('0')->nullable();
            $table->string('abr')->default('0')->nullable();
            $table->string('mai')->default('0')->nullable();
            $table->string('jun')->default('0')->nullable();
            $table->string('jul')->default('0')->nullable();
            $table->string('ago')->default('0')->nullable();
            $table->string('set')->default('0')->nullable();
            $table->string('out')->default('0')->nullable();
            $table->string('nov')->default('0')->nullable();
            $table->string('dez')->default('0')->nullable();
            $table->string('total')->default('0')->nullable();
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
        Schema::dropIfExists('annual_reports');
    }
}
