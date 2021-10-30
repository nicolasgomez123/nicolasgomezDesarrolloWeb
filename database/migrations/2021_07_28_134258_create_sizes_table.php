<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sizes', function (Blueprint $table) {
            
            $table->id();

            $table->string('name');
            
            //llave foranea
            $table->unsignedBigInteger('product_id');//referencia al id en la tabla products y que se borre en cascada
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

            //creacion de la tabla
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
        Schema::dropIfExists('sizes');
    }
}
