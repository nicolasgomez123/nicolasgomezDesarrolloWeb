<div class="container py-12">

    <!--formulario crear-->
    <x-jet-form-section submit="save" class="mb-6"><!--necesita 4 slots-->

        <x-slot name="title">
            Agregar una nueva marca
        </x-slot>

        <x-slot name="description">
            En esta seccion podra agrgar una nueva marca
        </x-slot>

        <x-slot name="form">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label>
                    Nombre
                </x-jet-label>

                <x-jet-input type="text" wire:model="createForm.name" class="w-full" />
                <x-jet-input-error for="createForm.name" /><!--verifica si hay algun error-->
            
            </div>
        </x-slot>

        <x-slot name="actions">
            <x-jet-button>
                Agregar
            </x-jet-button>
        </x-slot>
    </x-jet-form-section>

    <!--lista de marcas-->
<!--otro componente de jetstream-->
<x-jet-action-section><!--unicamente muestra contenido y necesita 3 slots-->
    <x-slot name="title">
        Lista de Marcas
    </x-slot>

    <x-slot name="description">
        Aqui encontrara todas las Marcas Agregadas
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
                @foreach ($brands as $brand)<!--almacene las subcategorias que encuentere en la variable subcategory-->
                    <tr>
                        <td class="py-2">
                   
                                                  <!--Ruta-->      <!--parametro-->          
                            <a class="uppercase">
                                {{$brand->name}}
                            </a>
                        </td>

                        <td class="py-2">
                            <div class="flex divide-x divide-gray-300 font-semibold"><!--linea de divicion divide-->
                                <a class="pr-2 hover:text-blue-600 cursor-pointer" wire:click="edit('{{$brand->id}}')">Editar</a>      <!--pasamos el evento en que sera recibido desde index.blade-->
                                <a class="pl-2 hover:text-red-600 cursor-pointer" wire:click="$emit('deleteBrand', '{{$brand->id}}')">Eliminar</a>
                            </div>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>


    </x-slot>
</x-jet-action-section>


<!--modal editar-->
<x-jet-dialog-modal wire:model="editForm.open" >
    
    <x-slot name="title">
        Editar Marca
    </x-slot>

    <x-slot name="content">
        <x-jet-label>
            Nombre
        </x-jet-label>

        <x-jet-input wire:model=editForm.name type="text" class="w-full" />
        <xjet-input-error for="editForm.name " />
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


@push('script')
    <script>        //evento         mandamos el id
    Livewire.on('deleteBrand', brandId =>{

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
                Livewire.emitTo('admin.brand-component', 'delete', brandId)

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
