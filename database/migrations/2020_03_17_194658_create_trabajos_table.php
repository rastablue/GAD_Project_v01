<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrabajosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trabajos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fake_id')->unique();
            $table->text('manobra')->nullable();
            $table->text('repuestos')->nullable();
            $table->float('costo_manobra')->unsigned()->nullable();
            $table->float('costo_repuestos')->unsigned()->nullable();
            $table->enum('estado', ['Activo', 'Inactivo', 'En espera', 'Finalizado'])->nullable();
            $table->enum('tipo', ['Preventivo', 'Correctivo'])->nullable();
            $table->foreignId('mantenimiento_id')->constrained()
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
        Schema::dropIfExists('trabajos');
    }
}
