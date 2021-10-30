<div x-data><!--inicia alpine-->

    <p class="text-gray-700 mb-4">
        <span class="font-semibold text-lg">
            Stock disponible:
        </span> {{$quantity}}
    </p>
    <!--ocupa el menor ancho posible-->
    <div class="flex">

        <!--cantidad en el carrito-->
        <div class="mr-4">
            <!--boton para agregar productos al carrito-->

            <!--boton izquierdo-->
            <x-jet-secondary-button 
            x-bind:disabled="$wire.qty <= 1"
            wire:loading.attr="disabled"
            wire:target="decrement"
            wire:click="decrement">
                    
                    -
            </x-jet-secondary-button>

            <span class="mx-2 text-gray-700">{{$qty}}</span>
        
            <!--boton derecho-->
            <x-jet-secondary-button
            x-bind:disabled="$wire.qty >= $wire.quantity"
            wire:loading.attr="disabled"
            wire:target="increment"
            wire:click="increment">
                +
            </x-jet-secondary-button>
        </div>

        <!--flex-1 ocupa todo el ancho posible-->
        <div class="flex-1">
            <x-button color="orange"
            x-bind:disabled="$wire.qty > $wire.quantity"
            class="w-full"
            wire:click="addItem"
            wire:loading.attr="disabled"
            wire:target="addItem">
                Agregar al carrito de compras
            </x-button>
        </div>
    </div>
</div>


