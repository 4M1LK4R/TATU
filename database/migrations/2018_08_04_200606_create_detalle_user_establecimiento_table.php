<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleUserEstablecimientoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_user_establecimientos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('id_establecimiento')->unsigned(); 
            $table->integer('id_user')->unsigned(); 

            //Relations
            $table->foreign('id_user')->references('id')->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreign('id_establecimiento')->references('id')->on('establecimientos')
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
        Schema::dropIfExists('detalle_user_establecimientos');
    }
}
