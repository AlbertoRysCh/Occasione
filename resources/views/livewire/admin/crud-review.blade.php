<div>

    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="font-semibold text-xl text-gray-600 leading-tight">
                Lista de reviews
            </h2>
 
        </div>
    </x-slot>


    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="container py-12">

        <x-table-responsive>

            <div class="px-6 py-4">

                <x-jet-input type="text" 
                    wire:model="search" 
                    class="w-full"
                    placeholder="Ingrese el nombre del usuario o producto que quiere buscar" />

            </div>

            @if ($reviews->count())
                
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nombre
                            </th> 
                            <th scope="col"
                                class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Start / Product
                            </th>
                            <th scope="col"
                                class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Comment
                            </th>
                            <th scope="col"
                                class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Estado
                            </th>
                            <th scope="col"
                                class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Fecha
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Editar</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">

                        @foreach ($reviews as $review)

                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $review->name }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">

                                    <div class="text-sm text-gray-900">
                                        {{ $review->rating }}
                                        <i class="fas fa-star"></i> 
                                    </div>

                                    <div class="text-sm text-gray-900"> 
                                        <a href="{{ route('products.show_id', $review->products_slug) }}">
                                            {{Str::limit($review->name_product, 30)}}.
                                        </a>
                                    </div>

                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">

                                    <div class="text-sm text-gray-900">
                                        @if($review->comment != null || $review->comment == "")
                                            <p>{{$review->comment}}</p>
                                        @endif
                                    </div>

                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @switch($review->status)
                                        @case(0)
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Borrador
                                            </span>
                                        @break
                                        @case(1)
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Publicado
                                            </span>
                                        @break
                                        @default

                                    @endswitch

                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{$review->time_review}}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    
                                    <a class="pr-2 hover:text-blue-600 cursor-pointer" wire:click="edit('{{$review->id}}')">Editar</a>
                                    {{-- <a href="{{ route('admin.reviews.edit', $review) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a> --}}
                                    {{-- <a class="text-indigo-600 hover:text-indigo-900">Edit</a> --}}
                                </td>
                            </tr>

                        @endforeach
                        <!-- More people... -->
                    </tbody>
                </table>

            @else
                <div class="px-6 py-4">
                    No hay ningún registro coincidente
                </div>
            @endif

            @if ($reviews->hasPages())
                
                <div class="px-6 py-4">
                    {{ $reviews->links() }}
                </div>
                
            @endif
                

        </x-table-responsive>
    </div>


    <x-jet-dialog-modal wire:model="editForm.open">

        <x-slot name="title">
            Editar Reviews
        </x-slot>

        <x-slot name="content">

            <div class="space-y-3">
 
                    <div class="flex"> 
                        <x-jet-label>
                            ¿Está location necesita habilitar?
                        </x-jet-label>
                        <div class="ml-auto">
                            <label>
                                <input type="radio" value="1" name="status" wire:model.defer="editForm.status">
                                Si
                            </label>
                            
                            <label class="ml-2">
                                <input type="radio" value="0" name="status" wire:model.defer="editForm.status">
                                No
                            </label>
                        </div>
                    </div>
                    
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-danger-button wire:click="update" wire:loading.attr="disabled" wire:target="update">
                Actualizar
            </x-jet-danger-button>
        </x-slot>

    </x-jet-dialog-modal>
    

</div>
