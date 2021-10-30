<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Livewire\ShoppingCart;
use App\Http\Livewire\CreateOrder;
use App\Http\Controllers\webhooksController;
use App\Http\Livewire\PaymentOrder;
use App\Models\Order;
use Illuminate\Routing\Route as RoutingRoute;

//Ruta para acceder a la pagina principal
Route::get('/', WelcomeController::class);

//Ruta para acceder a las busquedas de los productos
Route::get('search', SearchController::class)->name('search');

//Ruta para acceder a las categorias de los productos            metodo          nombre
Route::get('categories/{category}', [CategoryController::class, 'show' ])->name('categories.show');
             //como podemos tener muchas categorias  le especificamos en la url le pasamos el id de la categoria

//Ruta para acceder a la vista del producto
Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');
            //como podemos tener muchos productos  en la url le pasamos el id del producto

//Ruta para acceder al carrito de compras
Route::get('shopping-cart', ShoppingCart::class)->name('Shopping-Cart');



//solo usuarios autenticados pueden acceder a las siguientes rutas
Route::middleware(['auth'])->group(function(){

//nos mustra nuestras ordenes
Route::get('orders', [OrderController::class, 'index'])->name('orders.index');

//Ruta para añadir nuevos productos
Route::get('orders/create', CreateOrder::class)->name('orders.create');
                                                //middleware es para auntenticar usuarios

//ruta que se muestra luego de realizar el pago exitosamente
Route::get('orders/{order}', [OrderController::class, 'show'])->name('orders.show');
            //como podemos tener muchas ordenes en la url le pasamos el id de la orden                                                

//ruta en donde el usuario se encarga de pagar los productos
Route::get('orders/{order}/payment', PaymentOrder::class)->name('orders.payment');
            //como podemos tener muchas ordenes en la url le pasamos el id de la orden

//ruta para pagar las ordenes
Route::get('orders/{order}/pay', [OrderController::class, 'pay'])->name('orders.pay');
            
//ruta para los metodos de pago
Route::post('webhooks', WebhooksController::class);

});
