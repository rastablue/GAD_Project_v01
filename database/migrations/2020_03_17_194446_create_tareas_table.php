<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTareasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tareas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fake_id')->unique();
            $table->datetime('fecha_inicio');
            $table->datetime('fecha_fin')->nullable();
            $table->string('direc_tarea');
            $table->text('detalle')->nullable();
            $table->text('observacion')->nullable();
            $table->enum('estado', ['En Proceso', 'Pendiente', 'Abandonado', 'Finalizada']);
            $table->foreignId('solicitud_id')->constrained()
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
        Schema::dropIfExists('tareas');
    }
}
