<div>

    <header class="bg-white shadow">

        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <h1 class="font-semibold text-xl text-gray-800 leading-tight">
                    Productos
                </h1>

                <x-jet-danger-button
                wire:click="$emit('deleteProduct')">
                    Eliminar
                </x-jet-danger-button>
            </div>
        </div>

    </header>

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-gray-700">

    <h1 class="text-3xl text-center font-semibold mb-8">Complete esta informacion para crear un producto</h1>

    <div class="mb-4" wire:ignore><!--ignora esta parte de la pagina-->
    <!--mandamos las imagenes con el metodo POST -->
    <form action="{{route('admin.products.files', $product)}}"
      method="POST"
      class="dropzone"
      id="my-great-dropzone"></form>
    </div>

    <!--imagen-->
    @if ($product->images->count())<!--preguntamos si el producto tiene imagen y que cuent las imagenes relacionadas-->
        <!--si tiene que aparesca esta tarjeta-->
    <section class="bg-white shadow-xl rounded-lg p-6 mb-4">
        <h1 class="text-2xl text-center font-semibold mb-2">Imagenes del Producto</h1>
    
        <ul class="flex flex-wrap">
            @foreach ($product->images as $image)<!--recuperamos las imagenes  lo guardamos en una variable image-->
                
                                    <!--le damos una llave para no confundir a livewire al llamar muchas veces al mismi metodo-->
                <li class="relative" wire:key="image-{{$image->id}}">            <!--accedemos al metodo Storage y traemos la url de la imagen-->
                    <img class="w-32 h-20 object-cover" src="{{ Storage::url($image->url) }}" alt="" >
                    
                    <!--boton para eliminar imagenes-->
                    <x-jet-danger-button class="absolute right-2 top-2"
                        wire:click="deleteImage({{$image->id}})"
                        wire:loading.attr="disabled"
                        wire:target="deleteImage({{$image->id}})"><!--metodo deleteImage-->
                        x
                    </x-jet-danger-button>
                </li>

            @endforeach
        </ul>
    </section>
    @endif

    @livewire('admin.status-product', ['product' => $product], key('status-product'. $product->id))

    <div class="bg-white shadow-xl rounded-lg p-6">

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
                <select class="w-full form-control" wire:model='product.subcategory_id'><!--informa al componente de livewire del los cambios que hagamos-->
                    <option value="" Selected disabled>Seleccione una subcategoria</option><!--desavilita y selecciona al options como primer dato-->
                    
                    @foreach ($subcategories as $subcategory)
                        <option value="{{$subcategory->id}}">{{$subcategory->name}}</option>
                    @endforeach
                </select>
    
                <x-jet-input-error for="product.subcategory_id" /><!--verifica si hay un error en la validacion-->
    
            </div>
    
        </div>
    
        <!--Nombre-->
        <div class="mb-4">
            <x-jet-label value="Nombre" />
            <x-jet-input type="text" 
                         class="w-full"
                         wire:model="product.name" 
                         placeholder="ingrese el nombre del producto" /><!--propiedad name-->
    
                <x-jet-input-error for="product.name" /><!--verifica si hay un error en la validacion-->
        </div>
    
        <!--Slug-->
        <div class="mb-4">
            <x-jet-label value="Slug" />
            <x-jet-input type="text"
                         disabled
                         wire:model="product.slug" 
                         class="w-full bg-gray-200" 
                         placeholder="ingrese el Slug del producto" /><!--propiedad slug-->
            
                <x-jet-input-error for="product.slug" /><!--verifica si hay un error en la validacion-->        
        </div>
    
        <!--Descripcion-->
        <div class="mb-4">
    
            <x-jet-label value="Descripcion" />
    
                <div wire:ignore><!--a la hora de reiniciar la pagina eata parte no sufre cambios porque lo ignora -->
                <!--cuadro de texto grande-->
                <textarea class="w-full form-control" cols="30" rows="4"
                        wire:model="product.description"
                        x-data 
                        x-init="ClassicEditor.create( $refs.miEditor )
                        .then(function(editor){
                                editor.model.document.on('change:data', () => {
                                    @this.set('product.description', editor.getData())
                                })
                            })
                            .catch( error => {
                                console.error( error );
                            } );"
                        x-ref="miEditor">
                </textarea><!--inicializamos alpine y tambien le deciomos que inicialize Ckeditor y le damos un nombre-->
    
            <x-jet-input-error for="description" /><!--verifica si hay un error en la validacion-->        
        </div>
    
        <div  class="mb-4 grid grid-cols-2 gap-6">
            
            <!--marca-->
            <div>
                <x-jet-label value="Marca" /><!--componente jeetstrem-->
                <select class="form-control w-full" wire:model='product.brand_id'><!--resetea la marca segun la categoria que elejimos-->
                    <option value="" Selected disabled>Seleccione una marca</option>
                    @foreach ($brands as $brand)<!--iteracion de marcas a marca-->
                                <!--con-->
                        <option value="{{$brand->id}}">{{$brand->name}}</option>
                    @endforeach
                </select>
    
                <x-jet-input-error for="product.brand_id" /><!--verifica si hay un error en la validacion-->        
    
            </div>
    
            <!--Precio-->
            <div>
                <x-jet-label value="Precio" /><!--componente jeetstrem-->
                <x-jet-input
                    wire:model="product.price" 
                    type="number" 
                    class="w-full" 
                    step=".01"  /><!--se sincroniiza con la propiedad price-->
            </div>
    
            <x-jet-input-error for="product.price" /><!--verifica si hay un error en la validacion-->        
        </div>
    
        @if ($this->subcategory)
                <!-- !:ingresa a la condicion-->
            @if (!$this->subcategory->color && !$this->subcategory->size)
                
                <div>
                    <x-jet-label value="Cantidad" /><!--componente jeetstrem-->
                    <x-jet-input 
                        wire:model="product.quantity"
                        type="number" 
                        class="w-full"  /><!--se sincroniiza con la propiedad quantity-->
                        <x-jet-input-error for="product.quantity" /><!--verifica si hay un error en la validacion-->        
                </div>
    
    
            @endif 
        @endif
    
    
            <div class="flex justify-end items-center mt-4">

                <!--componente de jetstream-->
                <x-jet-action-message class="mr-3" on="saved"><!--escucha el evento-->
                    Actualizado
                </x-jet-action-message>

                <x-jet-button 
                wire:loading.attr="disabled"
                wire:target="save"
                wire:click="save">
                    <!--eventos-->
                    Actualizar producto<!--wire:loading.attr: desabilita el boton-->
                </x-jet-button><!--wire:target este evento solo se ejecuta para este metodo-->
            </div>

    </div>


    @if ($this->subcategory)<!--si el modelo subcategoria-->

        @if ($this->subcategory->size)<!--si el producto tiene talla-->

        <!--traemos la informacion de esta desde la carpeta admin-->
        @livewire('admin.size-product', ['product' => $product], key('size-product-'. $product->id))<!--esto se pone unicamente para distinguir las llaves-->
            
        @elseif($this->subcategory->color)<!--o si el producto tiene color-->

        <!--traemos la informacion de esta desde la carpeta admin-->
        @livewire('admin.color-product', ['product' => $product], key('color-product-'.$product->id))<!--esto se pone unicamente para distinguir las llaves-->

        @endif
        
    @endif
    
    <!--Dropzone Imagenes-->
    @push('script')
        <script>
                Dropzone.options.myGreatDropzone = { // camelized version of the `id`
                headers: {//token csrf
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                dictDefaultMessage: "Arraste o eliga una imagen en el recuadro",
                acceptedFiles: 'image/*',
                paramName: "file", // The name that will be used to transfer the file
                maxFilesize: 2, // MB
                complete: function(file){//luego de que la imagen se halla cargado
                    this.removeFile(file);//elimina la imagen del cuadro superior
                },
                queuecomplete: function(){
                    Livewire.emit('refreshProduct');
                }
            };
        </script>
    @endpush
</div>

</div>