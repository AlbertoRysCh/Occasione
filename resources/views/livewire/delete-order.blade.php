{{-- <i class="fas fa-trash"  wire:click="delete('{{$order}}')"></i>  --}}
{{-- <a class="flex items-center py-2 px-2 md:px-4 hover:bg-gray-100" wire:click="$emit('deleteOrder', '{{$order}}')"><i class="fas fa-trash"></i></a> --}}
<a class="ml-auto inline-flex justify-center items-center px-4 py-2 bg-gris border border-transparent rounded-md font-semibold text-xs text-black uppercase tracking-widest hover:bg-gris active:bg-gris focus:outline-none focus:border-gris focus:shadow-outline-orange disabled:opacity-25 transition text-center" wire:click="$emit('deleteOrder', '{{$order}}')">
    Eliminar  <i class="fas fa-trash"></i>
</a>


@push('scriptorder')
<script>
    Livewire.on('deleteOrder', orderId => {
    
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

                Livewire.emitTo('delete-order', 'delete', orderId)

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
  
