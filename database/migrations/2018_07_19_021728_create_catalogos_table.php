<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatalogosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalogos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->enum('estado', ['ACTIVO', 'INACTIVO'])->default('ACTIVO');        
            $table->integer('id_tipo_catalogo')->unsigned();
            $table->timestamps();
            //relation
            $table->foreign('id_tipo_catalogo')->references('id')->on('tipo_catalogos')
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
        Schema::dropIfExists('catalogos');
    }
}
