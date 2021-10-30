<?php

use App\Models\Order;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            
            //llave foranea
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');


            //status del producto
            $table->enum('status', [Order::PENDIENTE,
                                    Order::RECIBIDO,
                                    Order::ENVIADO,
                                    Order::ENTREGADO,
                                    Order::ANULADO,     
                                    ])->default(Order::PENDIENTE);//por defecto el status estara en pendiente

            $table->enum('envio_type', [1,2]);
            //1 = el usuario lo retira de la tieda
            //2 = se hace el envio al usuario

            //guarda la informacion del los contactos de  los clientes
            $table->string('contact');

            //guarda el numero de telefono de los clientes
            $table->string('phone');

            //costo de envio
            $table->float('shipping_cost');

            //costo total
            $table->float('total');

            //todos los productos del usuario
            $table->json('content');

            /*
            //llave foranea
            $table->unsignedBigInteger('department_id')->nullable();
            $table->foreign('department_id')->references('id')->on('departments');

            //llave foranea
            $table->unsignedBigInteger('city_id')->nullable();
            $table->foreign('city_id')->references('id')->on('cities');

            //llave foranea
            $table->unsignedBigInteger('district_id')->nullable();
            $table->foreign('district_id')->references('id')->on('districts');

            //Direccion de los clientes
            $table->string('address')->nullable();

            //Referencia de donde vive el cliente para la entrega
            $table->string('references')->nullable();

            //cuando fueron creados los campos*/
            
            //envios del cliente
            $table->json('envio')->nullable();

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
        Schema::dropIfExists('orders');
    }
}
