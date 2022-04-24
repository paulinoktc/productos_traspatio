<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduccionComunidad extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produccion_comunidad', function (Blueprint $table) {
            $table->id();
            $table->string('folio');
            $table->bigInteger('comunidad_id')->unsigned();
            $table->bigInteger('producto_id')->unsigned();
            $table->double('cantidad_produccion');
            $table->bigInteger('um_produccion_id')->unsigned();
            $table->double('cantidad_terreno')->default(0);
            $table->bigInteger('um_terreno_id')->unsigned()->nullable();
            $table->double('equivalencia_kg');
            $table->double('aprox_kg');
            $table->double('aprox_toneladas');
            $table->string('comentario')->nullable();
            $table->double('autoconsumo');
            $table->double('desperdicio');
            $table->double('venta');
            $table->double('porcentaje_total');
            $table->double('total_autoconsumo');
            $table->double('total_desperdicio');
            $table->double('total_venta');
            $table->foreign('comunidad_id')->references('id')->on('comunidades')->onDelete('cascade');
            $table->foreign('producto_id')->references('id')->on('productos')->onDelete('cascade');
            $table->foreign('um_produccion_id')->references('id')->on('um_produccion')->onDelete('cascade');
            $table->foreign('um_terreno_id')->references('id')->on('um_produccion')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produccion_comunidad');
    }
}
