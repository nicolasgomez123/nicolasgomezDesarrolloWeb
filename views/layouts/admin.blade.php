<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <!--fontawesome-->
        <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css')}}">

        <!--Dropzone CSS-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css" integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
       
        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>

        <!--Ckeditor-->
        <script src="https://cdn.ckeditor.com/ckeditor5/28.0.0/classic/ckeditor.js"></script>
    
        <!--Sweetalert2-->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
        <!--Dropzone-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js" integrity="sha512-oQq8uth41D+gIH/NJvSJvVB85MFk1eWpMK6glnkg6I7EdMqC1XVkW7RxLheXwmFdG03qScCM7gKS/Cx3FYt7Tg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    </head>

    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
            
            @livewire('navigation-menu')


            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            
            <!-- Page Content - contenido de pagina -->
            <main>
                {{ $slot }}
            </main>
      </div>

        @stack('modals')
        
        @livewireScripts

        <!--Este script es remplado desde show.blade.php-->
        @stack('script')


        <script>//swetalert2
            Livewire.on('errorSize', mensaje => {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: mensaje,
                })
            });
        </script>


<!--talla-->
        <script>
            Livewire.on('deleteSize', sizeId => {
         
         Swal.fire({
                 title: '¿Esta seguro?',
                 text: "¡No vas a poder revertir esto!",
                 icon: 'warning',
                 showCancelButton: true,
                 confirmButtonColor: '#3085d6',
                 cancelButtonColor: '#d33',
                 confirmButtonText: 'Si,borra esto!'
         }).then((result) => {
         if (result.isConfirmed) {

             Livewire.emitTo('admin.size-product','delete', sizeId)

         Swal.fire(
        '¡Eliminado!',
        'El archivo fue borrado.',
        'Correctamente'
         )
     }
 })
})
</script>

<!--Header-->
<script>
        Livewire.on('deleteProduct', () => {
    
            Swal.fire({
                    title: '¿Esta seguro?',
                    text: "¡No vas a poder revertir esto!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si,borra esto!'
            }).then((result) => {
            if (result.isConfirmed) {

               Livewire.emitTo('admin.edit-product','delete')

            Swal.fire(
            '¡Eliminado!',
            'El archivo fue borrado.',
            'Correctamente'
            )
        }
    })
})
</script>



<!--color-->
<script>
    Livewire.on('deletePivot', pivot => {
        
        Swal.fire({
                title: '¿Esta seguro?',
                text: "¡No vas a poder revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si,¡borra esto!'
        }).then((result) => {
        if (result.isConfirmed) {

            Livewire.emitTo('admin.color-product','delete', pivot)

        Swal.fire(
        '¡Eliminado!',
        'El archivo fue borrado.',
        'Correctamente'
        )
        }
    })
})
</script>

<!--color 2-->
<script>
    Livewire.on('deleteColorSize', pivot => {
        
        Swal.fire({
                title: '¿Esta seguro?',
                text: "¡No vas a poder revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, ¡borra esto!'
        }).then((result) => {
        if (result.isConfirmed) {

            Livewire.emitTo('admin.color-size','delete', pivot)

        Swal.fire(
        '¡Eliminado!',
        'El archivo fue borrado.',
        'Correctamente'
        )
        }
    })
})
</script>






    </body>
</html>
