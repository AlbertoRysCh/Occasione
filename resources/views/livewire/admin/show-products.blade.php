<?php
$configs = DB::table('configs')->first();
if ($configs != null) {
    $money = DB::table('locations')
        ->where([['id', '=', $configs->location_id]])
        ->value('money');
} else {
    $money = '';
}
?>

<div>

    {{-- <x-slot name="header">
       
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <h2 class="font-semibold text-xl text-gray-600 leading-tight">
                    Lista de productos
                </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <x-button-enlace class="ml-auto" href="{{route('admin.import_products.index')}}">
                  Import products
                </x-button-enlace>
                <x-button-enlace class="ml-4" href="{{route('admin.products.create')}}">
                    Crear nuevo producto
                </x-button-enlace>
            </div>
            
        </div> 
    </x-slot> --}}

    <div class="bg-white shadow-xl rounded-lg p-6 mb-4">
        <p class="text-2xl text-center font-semibold mb-2">Estado del producto</p>

        <div class="flex justify-center">

            <label class="mr-6">
                <input wire:model.defer="status" wire:click="$set('status', 1)" type="radio" name="status" value="1">
                Borrador
            </label>
            <label class="mr-6">
                <input wire:model.defer="status" wire:click="$set('status', 2)" type="radio" name="status" value="2">
                Publicado
            </label>
            <label>
                <input wire:model.defer="status" wire:click="$set('status', 3)" type="radio" name="status" value="3">
                Destacado
            </label>
            <label class="mr-6">
                <input wire:model.defer="status" wire:click="$set('status', 4)" type="radio" name="status" value="4">
                Agotado
            </label>
        </div>

        <div class="flex justify-end items-center">

            {{-- <x-jet-action-message class="mr-3" on="saved">
                Actualizado
            </x-jet-action-message> --}}

            <x-jet-button class="mt-4" wire:click="limpiar">
                Eliminar filtros
            </x-jet-button>
        </div>

    </div>

    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="container py-12">

        <x-table-responsive>

            <div class="px-6 py-4">

                <x-jet-input type="text" wire:model="search" class="w-full"
                    placeholder="Ingrese el nombre del procucto que quiere buscar" />

            </div>

            @if ($products->count())

                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nombre
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Categoría
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Estado
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Precio
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Precio Rebajado o Oferta
                            </th>

                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tipo de Producto
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('Stock') }}
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Editar</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">

                        @foreach ($products as $product)
                            <tr>
                                <td class="px-2 py-4">
                                    {{-- <td class="px-6 py-4 whitespace-nowrap"> --}}
                                    <div class="flex items-center">
                                        <div class="hidden md:flex flex-shrink-0 h-10 w-10">
                                            @if ($product->images->count())
                                                {{-- <img class="h-10 w-10 rounded-full object-cover"
                                                    src="{{ Storage::url($product->images->first()->url) }}" alt=""> --}}
                                                <img class="h-10 w-10 rounded-full object-cover"
                                                    src="{{ Storage::url(
                                                        DB::table('images')->leftJoin('products', 'products.id', '=', 'images.imageable_id')->orWhere('products.id', $product->id)->where('images.position', 'primary')->value('url'),
                                                    ) }}"
                                                    alt="">
                                            @else
                                                <img class="h-10 w-10 rounded-full object-cover"
                                                    src="https://images.pexels.com/photos/4883800/pexels-photo-4883800.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940"
                                                    alt="">
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                <a href="{{ route('products.show_id', $product->slug) }}">
                                                    {{ $product->name }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">

                                    <div class="text-sm text-gray-900">
                                        @if ($product->subcategory != null)
                                            {{ $product->subcategory->category->name }}
                                        @else
                                            {{ $product->category->name }}
                                        @endif
                                    </div>

                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @switch($product->status)
                                        @case(1)
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Borrador
                                            </span>
                                        @break

                                        @case(2)
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Publicado
                                            </span>
                                        @break

                                        @case(3)
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                Destacado
                                            </span>
                                        @break

                                        @case(4)
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Agotado
                                            </span>
                                        @break

                                        @default
                                    @endswitch

                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $money }} {{ $product->price }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $money }} {{ $product->sub_price }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">

                                    @switch($product->type_product)
                                        @case(1)
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Local
                                            </span>
                                        @break

                                        @case(2)
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Local
                                            </span>
                                        @break

                                        @case(3)
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Internacional
                                            </span>
                                        @break

                                        @case(4)
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Internacional
                                            </span>
                                        @break

                                        @default
                                    @endswitch

                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $product->quantity }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('admin.products.edit', $product) }}"
                                        class="text-indigo-600 hover:text-indigo-900">Edit</a>
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

            @if ($products->hasPages())
                <div class="px-6 py-4">
                    {{ $products->links() }}
                </div>
            @endif


        </x-table-responsive>
    </div>


</div>
