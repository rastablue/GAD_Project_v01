<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operarios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cedula')->unique();
            $table->string('name');
            $table->string('apellido_pater');
            $table->string('apellido_mater');
            $table->string('direc')->nullable();
            $table->string('tlf');
            $table->enum('tipo_contrato', ['Plazo Fijo', 'Prueba', 'Por Tarea', 'Eventual', 'Indefinido', 'Por Obra Cierta']);
            $table->enum('tipo_licencia', ['A', 'B', 'F', 'A1', 'C', 'C1', 'D', 'D1', 'E', 'E1', 'G']);
            $table->rememberToken();
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
        Schema::dropIfExists('operarios');
    }
}
