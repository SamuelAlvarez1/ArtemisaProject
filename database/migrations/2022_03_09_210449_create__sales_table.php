<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('_sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("idCustomers");
            $table->foreign("idCustomers")->references("id")->on("customers");
            $table->boolean("Status_sale");
            $table->date("creation_date");
            $table->float("Iva");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('_sales');
    }
}
