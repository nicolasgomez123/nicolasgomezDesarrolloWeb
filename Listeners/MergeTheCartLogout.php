<?php

namespace App\Listeners;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Auth\Events\Logout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;



class MergeTheCartLogout
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
     * @param  Logout  $event
     * @return void
     */
    public function handle(Logout $event)
    {
        //eliminar registro
        Cart::erase(auth()->user()->id);

        //nuevo registro
        Cart::store(auth()->user()->id);
        //todos los registros que realiza l usuario autenticado se guardaran en la migracion shopping-cart y se asocia a 
    }
}
