
<?php 
$configs = DB::table('configs')
 ->first(); 
 if($configs != null) {

  $money =  DB::table('locations')->where([
          ['id', '=', $configs->location_id],
          ])->value('money');
 }
?>

<div class="container py-8">
    <x-table-responsive>
        <div class="px-6 py-4 bg-white">
            <h1 class="text-lg font-semibold text-gray-700">CARRO DE COMPRAS</h1>
        </div>

        @if (Cart::count())
        @foreach (Cart::content() as $item)
                          
            <article class="flex px-10">
                <div class="flex justify-end"> 
                   
                    <figure class="flex justify-center"  style="margin: 10px 5px;">
                        <img class="h-30 w-30 object-cover object-center" src="{{ $item->options->image }}" alt="">
                    </figure>


                </div>

                <div class="py-4 px-2 w-full">
                    <a href="{{ route('products.show_id', ['id'=>$item->id]) }}">
                        <h1 class="text-lg-p font-semibold text-black">
                            {{$item->name}}
                        </h1>
                    </a>
                        <div class="text-sm text-gray-500">
                            @if ($item->options->color)
                                <span>
                                    Color: {{ __($item->options->color) }}
                                </span>    
                            @endif

                            @if ($item->options->size)

                                <span class="mx-1">-</span>

                                <span>
                                    {{ $item->options->size }}
                                </span>
                            @endif
                        </div> 
                        @if($item->sub_price != null || $item->sub_price != 0.0)
                            <div class="flex">
                                <p class="text-s my-1"  style="text-decoration: line-through rgba(109, 109, 109, 0.767); color:rgba(109, 109, 109, 0.767) ">{{$money}} {{ number_format($item->sub_price,2) }}</p> 
                                
                                <small class="ml-2 my-1">-{{$item->porcentaje}}%</small>
                            </div>
                        @endif
                        <div class="text-sm text-gray-500">
                            <p class="text-p" style="font-size: 1.05rem !important">
                                {{$money}} {{ number_format(($item->price * $item->qty),2) }}
                            </p>
                        </div>
                        
                        <div class="flex">
                            <div class="text-sm text-gray-500 mt-2">
                                {{-- <span>{{$money}} {{ $item->price }}</span> --}}
    
                                <a class="ml-2 cursor-pointer hover:text-red-600 font-bold"
                                    wire:click="delete('{{$item->rowId}}')"
                                    wire:loading.class="text-red-600 opacity-25"
                                    wire:target="delete('{{$item->rowId}}')">
                                    {{-- <i class="fas fa-trash"></i>  --}}
                                     Eliminar
                                </a>
                                
                            </div> 
                            <div class="text-sm text-gray-500" style="display: flex;justify-content: end;width: 100%;">
                                @if ($item->options->size)
    
                                    @livewire('update-cart-item-size', ['rowId' => $item->rowId], key($item->rowId))
    
                                @elseif($item->options->color)
    
                                    @livewire('update-cart-item-color', ['rowId' => $item->rowId], key($item->rowId))
                                    
                                @else
    
                                    @livewire('update-cart-item', ['rowId' => $item->rowId], key($item->rowId))
    
                                @endif
                            </div>
                        </div>
                        
                        
                </div>
            </article>

        @endforeach
 
            <div class="px-6 py-4">
                <a class="text-sm cursor-pointer hover:underline mt-3 inline-block" 
                    wire:click="destroy">
                    <i class="fas fa-trash"></i>
                    Borrar carrito de compras
                </a>
            </div>

        @else
            <div class="flex flex-col items-center">
                <x-cart />
                <p class="text-lg text-gray-700 mt-4">TU CARRO DE COMPRAS ESTÁ VACÍO</p>

                <x-button-enlace href="/" class="mt-4 px-16">
                    Ir al inicio
                </x-button-enlace>
            </div>
        @endif

    </x-table-responsive>

    <!-- This example requires Tailwind CSS v2.0+ -->



    @if (Cart::count())

        <div class="bg-white rounded-lg shadow-lg px-6 py-4 mt-4">
            <div class="flex justify-between items-center"> 
                <div>
                    <p class="text-gray-700">
                        <span class="font-bold text-lg">Total:</span>
                        {{$money}} {{ Cart::subTotal() }}
                    </p>
                </div>

                <div>
                    <x-button-enlace href="{{ route('orders.create') }}">
                        Continuar
                    </x-button-enlace>
                </div>
            </div>
        </div>

    @endif
</div>
