<div>
    <!--tarjeta color y cantidad--> 
    <div class="my-12 bg-white shadow-lg rounded-lg p-6">

        <!--Color-->
        <div class="mb-6">
            <x-jet-label><!--componente de jet-->
                Color
            </x-jet-label>


            <div class="grid grid-cols-6 gap-6">
                @foreach ($colors as $color)<!--itera la propiedad definida en el controlador-->
                <label><!--redondeado-->
                    <input type="radio" 
                    name="color_id"
                    wire:model.defer="color_id" 
                    value="{{$color->id}}"><!--tra el id del color-->
                    <span class="ml-2 text-gray-700 capitalize">
                        {{ __($color->name)}}<!--defer: ejecuta la peticion unicamente cuando pulsamos el boton -->
                    </span><!--imprime el nombre del color -->
                </label>
            @endforeach
            </div>

            <x-jet-input-error for="color_id" /><!--vrifique si hay alguna validacion en color_id-->

        </div>

        <!--cantidad-->
        <div>

            <x-jet-label>
                Cantidad
            </x-jet-label>

            <x-jet-input type="number"
            wire:model.defer="quantity"
            placeholder="ingrese una cantidad"
            class="w-full"/>

            <x-jet-input-error for="quantity" /><!--verifica la validacion en quantity-->

        </div>


        <div class="flex justify-end items-center mt-4">

            <!--componente de jetstream-->
            <x-jet-action-message class="mr-3" on="saved"><!--escucha el evento-->
                Agregado
            </x-jet-action-message>

            <x-jet-button 
            wire:loading.attr="disabled"
            wire:target="save"
            wire:click="save">
                <!--eventos-->
                Agregar<!--wire:loading.attr: desabilita el boton-->
            </x-jet-button><!--wire:target este evento solo se ejecuta para este metodo-->
        </div>

    </div>


    @if ($product_colors->count())<!--si tenemos un elemento en la tabla esta se muestra-->
        <!--Tabla--> 
    <div class="bg-white shadow-lg rounded-lg p-6">
        <table>
            <thead>
                <tr>
                    <th class="px-4 py-2 w-1/3">
                        Color
                    </th>

                    <th class="px-4 py-2 w-1/3"><!--padin  que ocupe un 1/3 de pantalla-->
                        Cantidad
                    </th>

                    <th class="px-4 py-2 w-1/3">

                    </th>
                </tr>
            </thead>

            <tbody>
                @foreach ($product_colors as $product_color)<!--iteracion-->
                    <tr wire:key="product_color-{{$product_color->pivot->id}}"><!--llave identifedicadora-->
                        <td class="capitalize px-4 py-2">
                            {{ __($colors->find($product_color->pivot->color_id)->name)}}
                        </td>           <!--filtro-->

                        <td class="px-4 py-2">
                            {{$product_color->pivot->quantity}}Unidades
                        </td><!--nos rescate la cantidad del product-color almacenada en el pivote quantity-->

                        <td class="px-4 py-2 flex">
                                <x-jet-secondary-button 
                                class="ml-auto mr-2"
                                wire:click="edit({{$product_color->pivot->id}})"
                                wire:loading.attr="disabled"
                                wire:target="edit({{$product_color->pivot->id}})"><!--cuando hacemos click en el boton actualizar acceda al metodo edit-->
                                Actualizar           
                                <!--nos rescate el id del product-color almacenada en el pivote id-->                                
                                </x-jet-secondary-button>


                                <x-jet-danger-button
                                    wire:click="$emit('deletePivot', {{ $product_color->pivot->id }})"><!-- se ejecuta este elemento magico cuando hagamos click y llame al id del producto -->
                                    Eliminar
                                </x-jet-danger-button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif

    

    <!--modal --> 
    <x-jet-dialog-modal wire:model="open">

        <x-slot name="title">
            Editar colores
        </x-slot>

        <x-slot name="content">
            <div class="mb-4">
                <x-jet-label>
                    Color
                </x-jet-label>

                <select class="form-control w-full"
                        wire:model="pivot_color_id"><!--sincronizamos lo valores-->
                        <option value="">Seleccione un color</option>  
                            @foreach ($colors as $color)
                                <option value="{{$color->id}}">
                                {{ucfirst(__($color->name))}}<!--trael el nombre del color con la primera letra capitalizada-->
                                </option>
                            @endforeach                                                                                                                                                           
                </select>
            </div>

            <div>
                <x-jet-label>
                    Cantidad
                </x-jet-label>                                  <!--referencia al modelo-->
            <x-jet-input class="w-full" type="number" wire:model="pivot_quantity"   placeholder="ingrese una cantidad" />
            </div>
        </x-slot>

        <x-slot name="footer">

            <x-jet-secondary-button
                wire:click="$set('open', false)"
                wire:loading.attr="disabled"
                wire:target="$set"><!-- utilizamos el metodo magico set en donde definimos que cuando se haga click al boton este pase a falso y se cierre-->
                Cancelar
            </x-jet-secondary-button><!--cuando se haga click se llame al metodo magico set y el boton quede unicamente desabilitado para este metodo-->


            <x-jet-button
            wire:click="update"
            wire:loading.attr="disabled"
            wire:target="update">
                Actualizar
            </x-jet-button><!--cuando se haga click se llame al metodo update y el boton quede unicamente desabilitado para este metodo-->
        </x-slot>

    </x-jet-dialog-modal>



</div>
