<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicituds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('codigo_solicitud')->unique();
            $table->datetime('fecha_emision');
            $table->datetime('fecha_revision')->nullable();
            $table->text('detalle')->nullable();
            $table->enum('estado', ['Aprobado', 'Reprobado', 'Pendiente'])->nullable();
            $table->foreignId('user_id')->constrained()
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('cliente_id')->constrained()
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
        Schema::dropIfExists('solicituds');
    }
}
