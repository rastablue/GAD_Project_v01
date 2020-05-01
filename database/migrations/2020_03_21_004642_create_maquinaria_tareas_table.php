<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaquinariaTareasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maquinaria_tarea', function (Blueprint $table) {
            $table->foreignId('maquinaria_id')->constrained()
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('tarea_id')->constrained()
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->integer('operador_id')->nullable();
            $table->enum('estado_tarea', ['Abandonado', 'En Proceso', 'Finalizada', 'Pendiente'])->nullable();
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
        Schema::dropIfExists('maquinaria_tarea');
    }
}
