<div x-data>
 <p class="text-xl text-gray-700">Color:</p>


    <!--selecciona el modelo color-->
    <select wire:model="color_id"  class="form-control w-full">

        <!--se sincroniza con la variable color en add-cart-item-color.blade-->
        <option value=""  disabled selected>Seleccionar un color</option>
        @foreach ($colors as $color)
            <option value="{{$color->id}}">{{ __($color->name) }}</option>
        @endforeach
    </select>

    <p class="text-gray-700 my-4">
        <span class="font-semibold text-lg">Stock disponible:</span>
        
        @if ($quantity)
        
            {{$quantity}}
        @else
            {{$product->stock}}
        @endif
    </p>


    <div class="flex ">

        <!--cantidad en el carrito-->
        <div class="mr-4">
            <!--boton para agregar productos al carrito-->

            <!--boton izquierdo-->
            <x-jet-secondary-button 
            x-bind:disabled="$wire.qty<=1"
            wire:loading.attr="disabled"
            wire:target="decrement"
            wire:click="decrement">
                    
                    -
            </x-jet-secondary-button>
            <span class="mx-2 text-gray-700">{{$qty}}</span>
        
            <!--boton derecho-->
            <x-jet-secondary-button
            x-bind:disabled="$wire.qty>=$wire.quantity"
            wire:loading.attr="disabled"
            wire:target="increment"
            wire:click="increment">

                    +
            </x-jet-secondary-button>
        </div>

        <!--flex-1 ocupa todo el ancho posible-->
        <div class="flex-1">
            
            <!-- el boton queda desabilitado cuando el boton de quantity es cero-->
            <x-button 
            x-bind:disabled="!$wire.quantity"
            color="orange"
            class="w-full"
            wire:click="addItem"
            wire:loading.attr="disabled"
            wire:target="addItem">
                Agregar al carrito de compras
            </x-button>
        </div>

    </div>
</div>
