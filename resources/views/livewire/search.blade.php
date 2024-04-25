<?php
$configs = DB::table('configs')->first();
?>

<div class="flex-1 relative" x-data>

    <form action="{{ route('search') }}" autocomplete="off">

        <x-jet-input name="name" wire:model="search" type="text" class="w-full"
            placeholder="¿Estás buscando algún producto?" />

        @if ($configs == null)
            <button
                class="absolute top-0 right-0 w-12 h-full bg-orange-500 flex items-center justify-center rounded-r-md">
                <x-search size="35" color="#ffffff" />
            @else
                <button class="absolute top-0 right-0 w-12 h-full flex items-center justify-center rounded-r-md"
                    style="background:{{ $configs->color_texto_menu }}">
                    <x-search size="35" color="{{ $configs->color_fondo_menu }}" />
        @endif

        </button>

    </form>

    <div class="absolute w-full mt-1 hidden" :class="{ 'hidden': !$wire.open }" @click.away="$wire.open = false">
        <div class="bg-white rounded-lg shadow-lg">
            <div class="px-4  py-3 space-y-1">
                @forelse ($products as $product)
                    <a href="{{ route('products.show', $product) }}" class="flex">

                        <img class="w-16 h-12 object-cover"
                            src="{{ Storage::url(
                                DB::table('images')->leftJoin('products', 'products.id', '=', 'images.imageable_id')->orWhere('products.id', $product->id)->where('images.position', 'primary')->value('url'),
                            ) }}"
                            alt="">

                        <div class="ml-4 text-gray-700">
                            <p class="text-lg font-semibold leading-5">{{ $product->name }}</p>
                            <p>Categoria: {{ $product->subcategory->category->name }}</p>
                        </div>
                    </a>
                @empty
                    <p class="text-lg leading-5">
                        No existe ningún registro con los parametros especificados
                    </p>
                @endforelse
            </div>
        </div>
    </div>
</div>
