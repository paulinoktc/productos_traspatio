<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComunidades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comunidades', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->bigInteger('municipio_id')->unsigned();
            $table->foreign('municipio_id')->references('id')->on('municipios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comunidades');
    }
}
