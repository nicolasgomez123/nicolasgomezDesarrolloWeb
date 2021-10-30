<x-admin-layout>
    <div class="container py-12">
        @livewire('admin.create-category')
    </div>


@push('script')
    <script>
    Livewire.on('deleteCategory', categorySlug =>{

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

                Livewire.emitTo('admin.create-category', 'delete', categorySlug)

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
</x-admin-layout>