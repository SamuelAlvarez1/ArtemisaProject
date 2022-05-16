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
            $table->unsignedBigInteger('idState');
            $table->foreign('idState')->references('id')->on('bookings_states');
            $table->bigInteger("amount_people");
            $table->dateTime("start_date");
            $table->dateTime("final_date")->nullable(true);
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
