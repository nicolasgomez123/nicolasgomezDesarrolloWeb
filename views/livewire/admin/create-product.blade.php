<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-gray-700">

    <h1 class="text-3xl text-center font-semibold mb-8">Complete esta informacion para crear un producto</h1>


    <div class="grid grid-cols-2 gap-6 mb-4">

        <!--Categoria-->
        <div>
            <x-jet-label value="Categorias" />
            <select class="w-full form-control" wire:model='category_id'><!--informa al componente de livewire del los cambios que hagamos-->
                <option value="" Selected disabled>Seleccione una categoria</option><!--desavilita y selecciona al options como primer dato-->
                
                @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>

            <x-jet-input-error for="category_id" /><!--verifica si hay un error en la validacion-->
        </div>

        <!--Subcategoria-->
        <div>
            <x-jet-label value="Subcategorias" />
            <select class="w-full form-control" wire:model='subcategory_id'><!--informa al componente de livewire del los cambios que hagamos-->
                <option value="" Selected disabled>Seleccione una subcategoria</option><!--desavilita y selecciona al options como primer dato-->
                
                @foreach ($subcategories as $subcategory)
                    <option value="{{$subcategory->id}}">{{$subcategory->name}}</option>
                @endforeach
            </select>

            <x-jet-input-error for="subcategory_id" /><!--verifica si hay un error en la validacion-->

        </div>

    </div>

    <!--Nombre-->
    <div class="mb-4">
        <x-jet-label value="Nombre" />
        <x-jet-input type="text" 
                     class="w-full"
                     wire:model="name" 
                     placeholder="ingrese el nombre del producto" /><!--propiedad name-->

            <x-jet-input-error for="name" /><!--verifica si hay un error en la validacion-->
    </div>

    <!--Slug-->
    <div class="mb-4">
        <x-jet-label value="Slug" />
        <x-jet-input type="text"
                     disabled
                     wire:model="slug" 
                     class="w-full bg-gray-200" 
                     placeholder="ingrese el Slug del producto" /><!--propiedad slug-->
        
            <x-jet-input-error for="slug" /><!--verifica si hay un error en la validacion-->        
    </div>

    <!--Descripcion-->
    <div class="mb-4">

        <x-jet-label value="Descripcion" />

        <div wire:ignore><!--a la hora de reiniciar la pagina eata parte no sufre cambios porque lo ignora -->
        <!--cuadro de texto grande-->
        <textarea class="w-full form-control" cols="30" rows="4"
                wire:model="description"
                x-data 
                x-init="ClassicEditor.create( $refs.miEditor )
                .then(function(editor){
                        editor.model.document.on('change:data', () => {
                            @this.set('description', editor.getData())
                        })
                    })
                    .catch( error => {
                        console.error( error );
                    } );"
                x-ref="miEditor">
        </textarea><!--inicializamos alpine y tambien le deciomos que inicialize Ckeditor y le damos un nombre-->
        </div>

        <x-jet-input-error for="description" /><!--verifica si hay un error en la validacion-->        
    </div>

    <div  class="mb-4 grid grid-cols-2 gap-6">
        
        <!--marca-->
        <div>
            <x-jet-label value="Marca" /><!--componente jeetstrem-->
            <select class="form-control w-full" wire:model='brand_id'><!--resetea la marca segun la categoria que elejimos-->
                <option value="" Selected disabled>Seleccione una marca</option>
                @foreach ($brands as $brand)<!--iteracion de marcas a marca-->
                            <!--con-->
                    <option value="{{$brand->id}}">{{$brand->name}}</option>
                @endforeach
            </select>

            <x-jet-input-error for="brand_id" /><!--verifica si hay un error en la validacion-->        

        </div>

        <!--Precio-->
        <div>
            <x-jet-label value="Precio" /><!--componente jeetstrem-->
            <x-jet-input
                wire:model="price" 
                type="number" 
                class="w-full" 
                step=".01"  /><!--se sincroniiza con la propiedad price-->
        </div>

        <x-jet-input-error for="price" /><!--verifica si hay un error en la validacion-->        
    </div>

    @if ($subcategory_id)<!--si tenemos algo almacenado en subcategory se comprueba la siguiente condicion-->

            <!-- !:ingresa a la condicion-->
        @if (!$this->subcategory->color && !$this->subcategory->size)
            
            <div>
                <x-jet-label value="Cantidad" /><!--componente jeetstrem-->
                <x-jet-input 
                    wire:model="quantity"
                    type="number" 
                    class="w-full"  /><!--se sincroniiza con la propiedad quantity-->
            </div>

            <x-jet-input-error for="quantity" /><!--verifica si hay un error en la validacion-->        

        @endif

    @endif

        <div class="flex mt-4">
            <x-jet-button 
            wire:loading.attr="disable"
            wire:target="save"
            wire:click="save"
            class="ml-auto"><!--eventos-->
                Crear producto<!--wire:loading.attr: desabilita el boton-->
            </x-jet-button><!--wire:target este evento solo se ejecuta para este metodo-->
        </div>

</div>
