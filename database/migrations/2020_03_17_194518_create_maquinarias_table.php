<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaquinariasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maquinarias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('codigo_nro_gad')->unique();
            $table->string('placa')->unique();
            $table->string('modelo');
            $table->string('anio')->nullable();
            $table->bigInteger('kilometraje')->unsigned()->nullable();
            $table->string('tipo_vehiculo')->nullable();
            $table->text('observacion')->nullable();
            $table->bigInteger('marca_id')->unsigned();
            $table->bigInteger('operario_id')->unsigned()->nullable();
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
        Schema::dropIfExists('maquinarias');
    }
}
