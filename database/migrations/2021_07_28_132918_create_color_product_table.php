<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColorProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('color_product', function (Blueprint $table) {
            $table->id();

            //llaves foraneas
            $table->unsignedBigInteger('color_id');//referencia al id en la tabla colors y que se borre en cascada
            $table->foreign('color_id')->references('id')->on('colors');

            $table->unsignedBigInteger('product_id');//referencia al id en la tabla products y que se borre en cascada
            $table->foreign('product_id')->references('id')->on('products');

            $table->integer('quantity');

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
        Schema::dropIfExists('color_product');
    }
}