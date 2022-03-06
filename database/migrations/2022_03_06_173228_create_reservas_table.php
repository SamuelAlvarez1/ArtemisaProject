<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("idCliente");
            $table->foreign("idCliente")->references("id")->on("clientes");
            $table->unsignedBigInteger("idEvento");
            $table->foreign("idEvento")->references("id")->on("eventos");
            $table->bigInteger("cantidad_personas");
            $table->boolean("estado");
            $table->date("fecha_inicio");
            $table->date("fecha_fin");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservas');
    }
}
