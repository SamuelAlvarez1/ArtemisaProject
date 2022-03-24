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
            $table->unsignedBigInteger("idEvent");
            $table->foreign("idEvent")->references("id")->on("events");
            $table->bigInteger("amount_people");
            $table->boolean("state");
            $table->date("start_date");
            $table->date("final_date");
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
