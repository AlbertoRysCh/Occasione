<x-admin-layout>
    
    <div class="container py-12">
        @livewire('admin.create-card-banner')
    </div>

    @push('script')
    <script>
        Livewire.on('deleteCardbanner', categorySlug => {
        
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {

                    Livewire.emitTo('admin.create-card-banner', 'delete', categorySlug)

                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })

        });
    </script>
    @endpush

</x-admin-layout>