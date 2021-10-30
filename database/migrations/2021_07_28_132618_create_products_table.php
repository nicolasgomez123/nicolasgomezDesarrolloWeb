<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Product;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            //entrada de caracteres varchar
            $table->string('name');//campo en donde se guardan los datos
            $table->string('slug');

            //entrada de texto
            $table->text('description');

            //entrada de numeros decimales
            $table->float('price');

            //llave foranea
            $table->unsignedBigInteger('subcategory_id');               //que los datos se eliminen en cascada
            $table->foreign('subcategory_id')->references('id')->on('subcategories')->onDelete('cascade');

            //llave foranea
            $table->unsignedBigInteger('brand_id');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');

            $table->integer('quantity')->nullable();

            //tabla dependiente de uno o otro factor
            $table->enum('status', [Product::BORRADOR, Product::PUBLICADO])->default(Product::BORRADOR);

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
        Schema::dropIfExists('products');
    }
}
