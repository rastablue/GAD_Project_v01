<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarcasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marcas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('marca');
            $table->timestamps();
        });

        Schema::table('maquinarias', function (Blueprint $table) {
            $table->foreign('marca_id')->references('id')->on('marcas')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('operario_id')->references('id')->on('operarios')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('marcas');
    }
}
