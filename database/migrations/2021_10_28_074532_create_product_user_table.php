<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_user', function (Blueprint $table) {
            $table->id();

            //campos

            //llaves foranea
            $table->unsignedBigInteger('product_id');//llave foranea que hace referencia a la migracion products y su informacion se borra en cascada el registro de la tabla intermedia
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

            $table->unsignedBigInteger('user_id');//llave foranea que hace referencia a la migracion users y su informacion se borra en cascada el registro de la tabla intermedia
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');


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
        Schema::dropIfExists('product_user');
    }
}
