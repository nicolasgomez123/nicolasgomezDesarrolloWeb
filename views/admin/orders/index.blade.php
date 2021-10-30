<x-admin-layout><!--plantilla principal-->

    <div class="container py-12"><!--py-12 para que no ste pagado hacia arriva ni abajo-->

        {{--Responsive--}}
                        {{--desde una pantalla mediana ocupa 4 columnas--}}
        <section class="grid md:grid-cols-4 gap-6 text-white"><!--entre columnaa y columna va a ver una separacion 1.5 rem-->
            

            <!--Cuadro 2-->                <!--le pasamos el parametro del status-->
            <a href="{{route('admin.orders.index'). "?status=2"}}" class="bg-gray-500 bg-opacity-80 rounded-lg px-12 pt-8 pb-4">
                <p class="text-center text-2xl">
                    {{$recibido}}<!--nos trae el status y lo cuenta-->
                </p>
                <p class="uppercase text-center">Recibido</p>
                <p class="text-center text-2xl mt-2">
                    <i class="fas fa-credit-card"></i>
                </p>
            </a>

            <!--Cuadro 3-->             <!--le pasamos el parametro del status-->
            <a href="{{route('admin.orders.index'). "?status=3"}}" class="bg-yellow-500 bg-opacity-80 rounded-lg px-12 pt-8 pb-4">
                <p class="text-center text-2xl">
                    {{$enviado}}<!--nos trae el status y lo cuenta-->
                </p>
                <p class="uppercase text-center">Enviado</p>
                <p class="text-center text-2xl mt-2">
                    <i class="fas fa-truck"></i>
                </p>
            </a>

            <!--Cuadro 4-->               <!--le pasamos el parametro del status-->
            <a href="{{route('admin.orders.index'). "?status=4"}}" class="bg-pink-500 bg-opacity-80 rounded-lg px-12 pt-8 pb-4">
                <p class="text-center text-2xl">
                    {{$entregado}}<!--nos trae el status y lo cuenta-->
                </p>
                <p class="uppercase text-center">Entregado</p>
                <p class="text-center text-2xl mt-2">
                    <i class="fas fa-check-circle"></i>
                </p>
            </a>

            <!--Cuadro 5-->            <!--le pasamos el parametro del status-->
            <a href="{{route('admin.orders.index'). "?status=5"}}" class="bg-green-500 bg-opacity-80 rounded-lg px-12 pt-8 pb-4">
                <p class="text-center text-2xl">
                    {{$anulado}}<!--nos trae el status y lo cuenta-->
                </p>
                <p class="uppercase text-center">Anulado</p>
                <p class="text-center text-2xl mt-2">
                    <i class="fas fa-times-circle"></i>
                </p>
            </a>

        </section>


        @if ($orders->count())<!--si exite algun registro de ordenes-->  
            <!--me muetre esta tarjeta-->
        <section class="bg-white shadow-lg rounded-lg px-12 py-8 mt-12 text-gray-700">
            <h1 class="text-2xl mb-4">Pedidos Recientes</h1>


            <ul>
                @foreach ($orders as $order)
                    <li>
                                        <!--ruta de administrador-->
                        <a href="{{Route('admin.orders.show', $order)}}" class="flex items-center py-2 px-4 hover:bg-gray-100">
                            <span class="w-12 text-center">
                                @switch($order->status)
                                    @case(1)<!--caso 1-->
                                        <i class="fas fa-business-time text-red-500 opacity-50"></i>
                                        @break
                                    @case(2)<!--caso 2-->
                                        <i class="fas fa-credit-card text-gray-500 opacity-50"></i>
                                        @break
                                    @case(3)<!--caso 3-->
                                        <i class="fas fa-truck text-yellow-500 opacity-50"></i>
                                        @break
                                    @case(4)<!--caso 4-->
                                        <i class="fas fa-check-circle text-pink-500 opacity-50"></i>
                                        @break
                                    @case(5)<!--caso 5-->
                                        <i class="fas fa-times-circle text-green-500 opacity-50"></i>
                                        @break
                                    
                                    @default
                                        
                                @endswitch
                            </span>


                            <span>
                                Orden: {{$order->id}}<!--recupera el id-->
                                <br>
                                {{$order->created_at->format('d/m/y')}}<!--recupera la fecha de creacion de la orden-->
                            </span>

                            <div class="ml-auto"><!--se posiciona a la derecha-->
                                <span class="font-bold">
                                    @switch($order->status)
                                        @case(1)
                                            Pendiente
                                            @break
                                        @case(2)
                                            Recibido
                                            @break
                                         @case(3)
                                            Enviado
                                            @break
                                        @case(4)
                                            Entregado
                                            @break
                                        @case(5)
                                            Anulado
                                            @break
                                        @default
                                            
                                    @endswitch
                                </span>

                                <br>

                                <span class="text-sm">
                                        {{$order->total}} USD<!--total-->
                                </span>
                            </div>


                            <span>
                                <i class="fas fa-angle-right ml-6"></i>
                            </span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </section>

        @else
            <div class="bg-white shadow-lg rounded-lg px-12 py-8 mt-12 text-gray-700">
                
                <span class="font-bold text-lg">
                    No existe registro de ordenes
                </span>

            </div>
        @endif

    </div>

</x-admin-layout>