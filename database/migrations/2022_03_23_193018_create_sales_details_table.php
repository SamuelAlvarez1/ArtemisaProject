<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("idSales");
            $table->foreign("idSales")->references("id")->on("sales");
            $table->unsignedBigInteger("idPlate");
            $table->foreign("idPlate")->references("id")->on("plates");
            $table->timestamps();
            $table->bigInteger("quantity");
            $table->double("platePrice");
<<<<<<< HEAD

=======
>>>>>>> 48110f4b569754a5e31a37e3b694f22bc1fad522
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_details');
    }
}
