
<?php 
$configs = DB::table('configs')
 ->first(); 
 if($configs != null) {

  $money =  DB::table('locations')->where([
          ['id', '=', $configs->location_id],
          ])->value('money');
 }
?>
<x-app-layout>

    <div class="container py-12">

        <section class="grid md:grid-cols-5 gap-6 text-white">
            <a href="{{ route('orders.index') . "?status=1" }}" class="bg-red-500 bg-opacity-75 rounded-lg px-12 pt-8 pb-4">
                <p class="text-center text-2xl">
                    {{$pendiente}}
                </p>
                <p class="uppercase text-center">Pendiente</p>
                <p class="text-center text-2xl mt-2">
                    <i class="fas fa-business-time"></i>
                </p>
            </a>

            <a href="{{ route('orders.index') . "?status=2" }}" class="bg-gray-500 bg-opacity-75 rounded-lg px-12 pt-8 pb-4">
                <p class="text-center text-2xl">
                    {{$recibido}}
                </p>
                <p class="uppercase text-center">Recibido</p>
                <p class="text-center text-2xl mt-2">
                    <i class="fas fa-credit-card"></i>
                </p>
            </a>

            <a href="{{ route('orders.index') . "?status=3" }}" class="bg-yellow-500 bg-opacity-75 rounded-lg px-12 pt-8 pb-4">
                <p class="text-center text-2xl">
                    {{$enviado}}
                </p>
                <p class="uppercase text-center">Enviado</p>
                <p class="text-center text-2xl mt-2">
                    <i class="fas fa-truck"></i>
                </p>
            </a>

            <a href="{{ route('orders.index') . "?status=4" }}" class="bg-pink-500 bg-opacity-75 rounded-lg px-12 pt-8 pb-4">
                <p class="text-center text-2xl">
                    {{$entregado}}
                </p>
                <p class="uppercase text-center">Entregado</p>
                <p class="text-center text-2xl mt-2">
                    <i class="fas fa-check-circle"></i>
                </p>
            </a>

            <a href="{{ route('orders.index') . "?status=5" }}" class="bg-green-500 bg-opacity-75 rounded-lg px-12 pt-8 pb-4">
                <p class="text-center text-2xl">
                    {{$anulado}}
                </p>
                <p class="uppercase text-center">Anulado</p>
                <p class="text-center text-2xl mt-2">
                    <i class="fas fa-times-circle"></i>
                </p>
            </a>
        </section>

        @if ($orders->count())
            
        
            <section class="bg-white shadow-lg rounded-lg px-2 md:px-8 py-8 mt-12 text-gray-700">
                <h1 class="text-2xl mb-4">Pedidos recientes</h1>
                
                <ul> 
                    @foreach ($orders as $order)
                        <li class="bg-white rounded-lg shadow-lg px-2 py-2 mb-4 text-gray-700 ">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                                <div>
                                    <a class="text-black w-full flex items-center py-2 px-2 hover:bg-gray-100">
                                    

                                        <span class="w-12 text-center">
                                            @switch($order->status)
                                                @case(1)
                                                    <i class="fas fa-business-time text-red-500 opacity-50"></i>
                                                    @break
                                                @case(2)
                                                    <i class="fas fa-credit-card text-gray-500 opacity-50"></i>
                                                    @break
                                                @case(3)
                                                    <i class="fas fa-truck text-yellow-500 opacity-50"></i>
                                                    @break
                                                @case(4)
                                                    <i class="fas fa-check-circle text-pink-500 opacity-50"></i>
                                                    @break
                                                @case(5)
                                                    <i class="fas fa-times-circle text-green-500 opacity-50"></i>
                                                    @break
                                                @default
                                                    
                                            @endswitch
                                        </span>
        
                                        <span>
                                            Pedido: N° {{$order->id}} |
                                            Comprado el {{$order->created_at->format('d/m/Y')}} | 
                                            Total: {{$money}}  {{$order->total}}
                                        </span>
        
                                        {{-- <div class="ml-auto"> 
                                            <span class="text-sm">
                                            {{$money}}  {{$order->total}}
                                            </span>
                                        </div> --}}
        
                                        {{-- <span>
                                            <i class="fas fa-angle-right ml-6"></i>
                                        </span> --}}
        
                                    </a>
                                </div>
                                <div class="grid grid-cols-2 md:grid-cols-1 gap-2 text-center">
                                    <div class="py-2">
                                        <a href="{{route('orders.show', $order)}}" class="ml-auto inline-flex justify-center items-center px-4 py-2 bg-orange-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-orange-600 active:bg-orange-500 focus:outline-none focus:border-orange-500 focus:shadow-outline-orange disabled:opacity-25 transition text-center">Ver pedido</a>
                                    </div>
    
                                    <div class="py-2">
                                      @switch($order->status)
                                            @case(1) 
                                               @livewire('delete-order', ['order' => $order->id]) 
                                            @break
                                            @default 
                                        @endswitch 
                                    </div>
                                </div> 
                                    
                            </div>
                            
                            
                                @switch($order->status)
                                    @case(1)
                                    <span class="font-bold px-4" style="color:grey">
                                        Pendiente 
                                    </span>
                                        @break
                                    @case(2)
                                    <span class="font-bold px-4" style="color:blue">
                                        Recibido
                                    </span>
                                        @break
                                    @case(3)
                                    <span class="font-bold px-4" style="color:#f5b346"> 
                                        Enviado
                                    </span>
                                        @break
                                    @case(4)
                                    <span class="font-bold px-4" style="color:green">
                                        Entregado
                                    </span>
                                        @break
                                    @case(5)
                                    <span class="font-bold px-4" style="color:red">
                                        Anulado
                                    </span>
                                        @break
                                    @default
                                        
                                @endswitch
 
                                @livewire('item-order', ['order' => $order]) 
                              
                        </li>
                        
                      
                       
                    @endforeach
                </ul>
            </section>

        @else
        <div class="bg-white shadow-lg rounded-lg px-12 py-8 mt-12 text-gray-700">
            <span class="font-bold text-lg">
                No existe registros de ordenes
            </span>
        </div>
        @endif

    </div>
   
</x-app-layout>