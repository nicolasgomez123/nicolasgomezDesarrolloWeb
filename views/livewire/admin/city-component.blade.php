<div>

    <!--Nombre de la provincia-->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight capitalize">
            Ciudad: {{$city->name }}
        </h2>
    </x-slot>


    <div class="container py-12">

        <!--Agregar distrito -->
    
        <!--componente de formulario jetstream-->
        <x-jet-form-section submit="save" class="mb-6"><!--necesita que especifiquemos el metodo-->
            <!--nesecita 4 slots-->
    
            <x-slot name="title">
                Agregar una nuevo Distrito
            </x-slot>
    
            <x-slot name="description">
                Complete la informacion necesaria para agregar un nuevo Distrito
            </x-slot>
    
            <x-slot name="form">
    
                <div class="col-span-6 sm:col-span-4">
    
                    <x-jet-label>
                        Nombre
                    </x-jet-label>
                                        <!--sincronizamos con la propiedad-->
                <x-jet-input wire:model.defer="createForm.name" type="text" class="w-full mt-1" />
    
                <x-jet-input-error for="createForm.name" /><!--verifique si hay un eeror de validacion en los campos-->
                </div>

                
    
            </x-slot>
    
            <x-slot name="actions">
    
                <!--boton fantasma-->
                <x-jet-action-message class="mr-3" on="saved"><!--mensaje que se desvaneze-->
                    Distrito agregada
                </x-jet-action-message>
    
                <x-jet-button><!--boton-->
                    Agregar
                </x-jet-button>
    
            </x-slot>
    
        </x-jet-form-section>
    
        <!--Mostrar distritos-->
    
         <!--otro componente de jetstream-->
         <x-jet-action-section><!--unicamente muestra contenido y necesita 3 slots-->
            <x-slot name="title">
                Lista de Distritos
            </x-slot>
    
            <x-slot name="description">
                Aqui encontrara todos los Distritos agregados
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
                        @foreach ($districts as $district)<!--almacene las ciudades que encuentere en la variable city-->
                            <tr>
                                <td>  <!--nombre del distrito-->
                                    {{$district->name}}   
                                </td>
    
                                <td class="py-2">
                                    <div class="flex divide-x divide-gray-300 font-semibold"><!--linea de divicion divide-->
                                        <a class="pr-2 hover:text-blue-600 cursor-pointer" wire:click="edit({{$district}})">Editar</a>      <!--pasamos el evento en que sera recibido desde index.blade-->
                                        <a class="pl-2 hover:text-red-600 cursor-pointer" wire:click="$emit('deleteDistrict',  {{$district}} )">Eliminar</a>
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
            Editar Distrito
        </x-slot>
    
        <x-slot name="content">
    
        <div class="space-y-3">
    
            <!--input nombre-->
            <div><!--en pantallas pequenas ocupa 4 columnas-->
                <x-jet-label><!--para que ocupe las 6 columnas-->
                    Nombre
                </x-jet-label>
        
                <!--quiero que se sincronise con el dato del array name y quiero enterarme si s modifico algo para eso uso el defer-->
                <x-jet-input wire:model="editForm.name" class="w-full mt-4" type="text" /><!--3-->
                <x-jet-input-error for="editForm.name" /><!--verifica si hay un error en el campo name-->
            </div>
    
        </div>
        
    </x-slot>

        <x-slot name="footer">
    
            <x-jet-danger-button
            wire:click="update"
            wire:loading.attr="disabled"
            wire:target="update">
                Actualizar
            </x-jet-danger-button>
        </x-slot>
    
    </x-jet-dialog-modal>
    </div>


    @push('script')
    <script>        //evento         mandamos el id
            Livewire.on('deleteDistrict', districtId =>{

                Swal.fire({
                    title: '¿Estas seguro?',
                    text: "¡No vas a poder revertir esto!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'si, ¡eliminalo!'
                }).then((result) => {
                    if (result.isConfirmed) {
                                    //mandamos desde admin.show-category el evento delete con subcategoryid
                        Livewire.emitTo('admin.city-component', 'delete', districtId)

                        Swal.fire(
                        '¡Eliminado!',
                        'Tu archivo a sido eliminado.',
                        'Correctamente'
                    )
                }
            })
        });
    </script>
@endpush


</div>
