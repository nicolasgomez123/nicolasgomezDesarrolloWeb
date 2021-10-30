<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubcategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subcategories', function (Blueprint $table) {
            $table->id();

            //datos de tipo varchar
            $table->string('name');
            $table->string('slug');

            
            //datos boleanos vedaderos o falsos
            $table->boolean('color')->default(false);
            $table->boolean('size')->default(false);

            //llave foranea
            $table->unsignedBigInteger('category_id');                    //que los datos se eliminen en cascada
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

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
        Schema::dropIfExists('subcategories');
    }
}
