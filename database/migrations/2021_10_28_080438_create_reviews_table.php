<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->text('comment');
            $table->integer('rating');

            //llaves foraneas

            //relacion muchos a muchos
            $table->unsignedBigInteger('user_id');                   //tabla
            $table->foreign('user_id')->references('Id')->on('users');

            //relacion muchos a muchos
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('Id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
