<div>
    <!--formulario de jetstream-->
    <x-jet-form-section submit="save" class="mb-6"><!--necesita cuatro campos slots-->
        <x-slot name="title"><!--1-->
            Crear una nueva categoria
        </x-slot>

        <x-slot name="description">
            Complete la informacion del producto
        </x-slot>

        <x-slot name="form"><!--2-->  

            <!--input nombre-->
            <div class="col-span-6 sm:col-span-4"><!--en pantallas pequenas ocupa 4 columnas-->
                <x-jet-label><!--para que ocupe las 6 columnas-->
                    Nombre
                </x-jet-label>

                <!--quiero que se sincronise con el dato del array name y quiero enterarme si s modifico algo para eso uso el defer-->
                <x-jet-input wire:model="createForm.name" class="w-full mt-4" type="text" /><!--3-->
                
                <x-jet-input-error for="createForm.name" /><!--verifica si hay un error en el campo name-->
            </div>

            <!--input slug-->
            <div class="col-span-6 sm:col-span-4"><!--en pantallas pequenas ocupa 4 columnas-->
                <x-jet-label><!--para que ocupe las 6 columnas-->
                    Slug
                </x-jet-label>

                <x-jet-input disabled wire:model="createForm.slug"  class="w-full mt-4 bg-gray-200" type="text" /><!--3-->
                
                <x-jet-input-error for="createForm.slug" /><!--verifica si hay un error en el campo sluge-->
            </div>

            <!--input icono-->
            <div class="col-span-6 sm:col-span-4"><!--en pantallas pequenas ocupa 4 columnas-->
                <x-jet-label><!--para que ocupe las 6 columnas-->
                    Icono
                </x-jet-label>

                <x-jet-input wire:model="createForm.icon"  class="w-full mt-4" type="text" /><!--3-->
            
                <x-jet-input-error for="createForm.icon" /><!--verifica si hay un error en el campo icon-->


                <!--seleccionar marcas-->
                <div class="col-span-6 sm:col-span-4">
                    Marcas
                </div>

                <div class="grid grid-cols-4">

                    @foreach ($brands as $brand)<!--itere todas las marcas en una variable llamada brand-->
                    
                        <x-jet-label>
                        <!--cajitas en donde se marcan opciones-->
                            <x-jet-checkbox 
                            wire:model.defer="createForm.brands"
                            name="brands[]"
                            value="{{$brand->id}}" /><!--lo sincronizamos con el dato del array brans y su valor seran el id de las marcas-->
                            {{$brand->name}}
                        </x-jet-label>

                    <x-jet-input-error for="createForm.brands" /><!--verifica si hay un error en el campo brands-->

                    @endforeach
                </div>


                <!--input imagenes-->
            <div class="col-span-6 sm:col-span-4"><!--en pantallas pequenas ocupa 4 columnas-->
                <x-jet-label><!--para que ocupe las 6 columnas-->
                    Imagen
                </x-jet-label>
                                <!--quiero que acepte unicamente imagenes por eso accept-->
                <input wire:model="createForm.image" accept="image/*" type="file" class="mt-4" id="{{$rand}}">
                <x-jet-input-error for="createForm.image" /><!--verifica si hay un error en el campo image-->

            </div>

        </x-slot>

        

        <x-slot name="actions"><!--4-->

            <x-jet-action-message class="mr-3" on="saved"><!--escucha el evento saved-->
                Categoria Creado
            </x-jet-action-message>

            <x-jet-button>
                Agregar
            </x-jet-button>
        </x-slot>

    </x-jet-form-section>
</div>
    <!--otro componente de jetstream-->
    <x-jet-action-section><!--unicamente muestra contenido y necesita 3 slots-->
        <x-slot name="title">
            Lista de Categorias
        </x-slot>

        <x-slot name="description">
            Aqui encontrara todas las categorias Agregadas
        </x-slot>

        <x-slot name="content">

            <table class="text-gray-600">
                <thead class="border-b border-gray-300">
                    <tr class="text-left">
                        <th class="py-2 w-full">Nombre</th>
                        <th class="py-2">Accion</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-300">
                    @foreach ($categories as $category)<!--almacene las categorias que encuentere en la variable category-->
                        <tr>
                            <td class="py-2">
                                <span class="inline-block w-8 text-center mr-8">
                                    {!!$category->icon!!}<!--!! !!muestra el texto html -->
                                </span>
                                                      <!--Ruta-->      <!--parametro-->          
                                <a href="{{route('admin.categories.show',  $category)}}" class="uppercase underline hover:text-blue-500">
                                    {{$category->name}}
                                </a>
                            </td>

                            <td class="py-2">
                                <div class="flex divide-x divide-gray-300 font-semibold"><!--linea de divicion divide-->
                                    <a class="pr-2 hover:text-blue-600 cursor-pointer" wire:click="edit('{{$category->slug}}')">Editar</a>      <!--pasamos el evento en que sera recibido desde index.blade-->
                                    <a class="pl-2 hover:text-red-600 cursor-pointer" wire:click="$emit('deleteCategory', '{{$category->slug}}')">Eliminar</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>


        </x-slot>
    </x-jet-action-section>


<!--Modal editar de jetstrem-->
 <x-jet-dialog-modal wire:model="editForm.open"><!--nesecita tres slots-->

    <x-slot name="title">
        Editar categoria
    </x-slot>

    <x-slot name="content">

    <div class="space-y-3">

    <!--imagen en la parte superior de la tarjeta-->

    <div>                
        
        @if ($editImage)<!--si tenemos algo almacenado en editImage-->
                                                                <!--recuperamos el url de la imagen temporal-->
            <img class="w-full h-64 object-cover object-center" src="{{$editImage->temporaryUrl()}}">
        @else
                                                            <!--recuperamos la imagen-->
            <img class="w-full h-64 object-cover object-center" src="{{Storage::url($editForm['image'])}}">
        @endif                                                          <!--recuperamos la url-->
        
    </div>

    <!--input nombre-->
            <div><!--en pantallas pequenas ocupa 4 columnas-->
                <x-jet-label><!--para que ocupe las 6 columnas-->
                    Nombre
                </x-jet-label>

                <!--quiero que se sincronise con el dato del array name y quiero enterarme si s modifico algo para eso uso el defer-->
                <x-jet-input wire:model="editForm.name" class="w-full mt-4" type="text" /><!--3-->
                
                <x-jet-input-error for="editForm.name" /><!--verifica si hay un error en el campo name-->
            </div>

            <!--input slug-->
            <div><!--en pantallas pequenas ocupa 4 columnas-->
                <x-jet-label><!--para que ocupe las 6 columnas-->
                    Slug
                </x-jet-label>

                <x-jet-input disabled wire:model="editForm.slug"  class="w-full mt-4 bg-gray-200" type="text" /><!--3-->
                
                <x-jet-input-error for="editForm.slug" /><!--verifica si hay un error en el campo sluge-->
            </div>

            <!--input icono-->
            <div><!--en pantallas pequenas ocupa 4 columnas-->
                <x-jet-label><!--para que ocupe las 6 columnas-->
                    Icono
                </x-jet-label>

                <x-jet-input wire:model="editForm.icon"  class="w-full mt-4" type="text" /><!--3-->
            
                <x-jet-input-error for="editForm.icon" /><!--verifica si hay un error en el campo icon-->


                <!--seleccionar marcas-->
                <div>
                    Marcas
                </div>

                <div class="grid grid-cols-4">

                    @foreach ($brands as $brand)<!--itere todas las marcas en una variable llamada brand-->
                    
                        <x-jet-label >
                        <!--cajitas en donde se marcan opciones-->
                            <x-jet-checkbox 
                            wire:model.defer="editForm.brands"
                            name="brands[]"
                            value="{{$brand->id}}" /><!--lo sincronizamos con el dato del array brans y su valor seran el id de las marcas-->
                            {{$brand->name}}
                        </x-jet-label>

                    <x-jet-input-error for="editForm.brands" /><!--verifica si hay un error en el campo brands-->

                    @endforeach
                </div>

  </div>
                <!--input imagenes-->
            <div>
                <x-jet-label><!--para que ocupe las 6 columnas-->
                    Imagen
                </x-jet-label>
                                <!--quiero que acepte unicamente imagenes por eso accept-->
                <input wire:model="editImage" accept="image/*" type="file" class="mt-1" id="{{$rand}}">
                <x-jet-input-error for="editImage" /><!--verifica si hay un error en el campo image-->

            </div>
    </div>
    


    </x-slot>
    <x-slot name="footer">

        <x-jet-danger-button
        wire:click="update"
        wire:loading.attr="disabled"
        wire:target="editImage, update">
            Actualizar
        </x-jet-danger-button>
    </x-slot>


</x-jet-dialog-modal>
</div>
