<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();
            $table->string("nombre");
            $table->bigInteger("valor_decoracion");
            $table->bigInteger("valor_entrada");
            $table->string("descripcion");
            $table->boolean("estado");
            $table->date("fecha_inicio");
            $table->date("fecha_fin");
            $table->string("espacio");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eventos');
    }
}
