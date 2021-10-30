@props(['category'])

<div class="grid grid-cols-4 p-4">

    <div>
        <p class="text-lg font-bold text-center text-trueGray-500 mb-3 ">Subcategorias</p>

        <ul>        <!--recuperamos la informacion entre category y subcategories, y lo almacenamos en la variable subcategory-->
            @foreach ($category->subcategories as $subcategory)
                <li>             <!--le pasamos las ruta, parametros  lo concatenamos con la subcategoria-->
                    <a href="{{route('categories.show', $category) . '?subcategoria=' . $subcategory->slug}}" class="text-trueGray-500 inline-block font-semibold py-1 px-4 hover:text-orange-500">
                        {{$subcategory->name}}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="col-span-3">

        <img class="h-64 w-full object-cover object-center" src="{{Storage::url($category->image)}}" alt="">
    
    </div>

</div>