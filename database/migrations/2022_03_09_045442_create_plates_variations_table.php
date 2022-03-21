<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlatesVariationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plates_variations', function (Blueprint $table) {
            $table->id();
            $table->string("variation");
            $table->decimal("price");
            $table->string("description");
            $table->boolean("state");
            $table->unsignedBigInteger("idPlate");
            $table->foreign("idPlate")->references("id")->on("plates");
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
        Schema::dropIfExists('plates_variations');
    }
}
