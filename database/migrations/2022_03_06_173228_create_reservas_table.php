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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("idCustomer");
            $table->foreign("idCustomer")->references("id")->on("customers");
            $table->unsignedBigInteger("idEvent")->nullable(true);
            $table->foreign("idEvent")->references("id")->on("events");
            $table->unsignedBigInteger('idUser');
            $table->foreign('idUser')->references('id')->on('users');
            $table->bigInteger("amount_people");
            $table->boolean("state");
            $table->dateTimeTz("start_date");
            $table->dateTimeTz("final_date");
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
        Schema::dropIfExists('reservas');
    }
}
