<?php

namespace App\Listeners;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

//almacenar productos a la base de datos

class MergeTheCart
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        //fuciona o almacena los productos que tenga el usuario en el carrito de compras
        Cart::merge(auth()->user()->id);
    }
}
