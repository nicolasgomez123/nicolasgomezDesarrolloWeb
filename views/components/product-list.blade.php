@props(['product'])<!--le especificamos que la informacion que vamos a pasar es la informacion del producto -->

<li class="bg-white rounded-lg shadow mb-4">
    <article class="md:flex">
        <figure>           <!--responsibe-->
            <img class="h-48 w-full md:w-56 object-cover object-center" src="{{Storage::url($product->images->first()->url)}}" alt="">
        </figure>

        

        <div class="flex-1 py-4 px-6 flex flex-col">
            <div class="lg:flex justify-between">
                <div>
                    <!--Titulo y precio del producto en la lista-->
                    <h1 class="text-lg font-semibold text-gray-700">{{$product->name}}</h1>
                    <p class="font-bold text-gray-700">USD {{$product->price}}</p>
                

                <!--Las estrellas que se muetran del lado derecho de la lista y las personas que la calificaron-->
                <div class="flex items-center">
                    <ul class="flex text-sm">
                        <li>
                            <i class="fas fa-star text-yellow-400 mr-4 "></i>
                        </li> 
                        <li> 
                            <i class="fas fa-star text-yellow-400 mr-4"></i>
                        </li> 
                        <li> 
                            <i class="fas fa-star text-yellow-400 mr-4"></i>
                        </li> 
                        <li> 
                            <i class="fas fa-star text-yellow-400 mr-4"></i>
                        </li> 
                        <li> 
                            <i class="fas fa-star text-yellow-400 mr-4"></i>
                        </li>
                    </ul>

                    <span class="text-gray-700 text-center">(24)</span>
                </div>
            </div>

            
                <!--Boton de mas informacion-->
                <div class="mt-4 md:mt-auto mb-4"><!--responsibe-->
                    <x-danger-enlace href="{{ route('products.show', $product)}}" >
                        Mas Informacion
                    </x-danger-enlace>
                </div>
                </div>
        </div>
    </article>
</li>