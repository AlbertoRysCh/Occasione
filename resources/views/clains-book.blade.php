<?php
   $configs = DB::table('configs')
   ->first(); 
   if($configs != null){
    $location = DB::table('locations')
    ->leftJoin('configs', 'configs.location_id', '=', 'locations.id')
    ->where('locations.id',$configs->location_id)
    ->value('locations.url_dom');
   } 
?>

<x-app-layout> 

    
<style>
    .clains-h1{
        border-bottom: 1px solid #000000;
        font-size:22px;
        font-weight: 800;
    }
    .clains-h2{
        border-bottom: 1px solid #000000;
        font-size:20px;
        font-weight: 800;
    }
    .btn1 {
        border:0; 
        border-radius: 100px;
        width: 340px;
        height: 49px;
        font-size: 16px; 
        top: 79%;
        left: 8%;
        transition: 0.3s;
        cursor: pointer;
        }
    .btn1 { 
        background: <?=$configs->color_fondo_menu?>;
        color: <?=$configs->color_texto_menu?>;
        box-shadow: 1px 1px 1px 1px <?=$configs->color_texto_menu?>;
    }

    .btn1:hover {
        background: <?=$configs->color_texto_menu?>;
        color: <?=$configs->color_fondo_menu?>;
    }
        
    .input-clains{
        width: 500px;
    }
    .inputx-clains{
        width: 350px;
    }
</style>
        {{-- Muestra Cada dos categoria OBS: Se duplica este metodo --}}
    <div class="container py-8 px-4">
      
        <h1 class="clains-h1 px-4 py-3">LIBRO DE RECLAMACIONES VIRTUAL</h1>
        <p class="py-3">
            ¡Hola! Si tienes cualquier consulta o requieres una atención inmediata, 
            te invitamos a usar nuestro canal de atención: 
            @if($configs != null)
               <a href="{{$location}}/contactanos">{{$location}}/contactanos</a> 
            @endif

            Gracias por ayudarnos a mejorar nuestro servicio.
        </p>
        
    @livewire('claims-book')
    {{-- <form method="post" action="{{route('clains-book-send')}}">
        @csrf
       
           <div class="w-full flex justify-center py-4">
                <input type="submit" value="{{__('Send')}}" class="btn1">
           </div>
    </form> --}}

           <div class="w-full flex justify-center py-4" style="font-size:19px;color:#636363">
                <i class="fas fa-print"></i>
                <p class="px-4">Para imprimir esta página que contiene tu hoja de reclamación, puedes presionar Ctrl+P</p>
           </div>
        </div>
    </div>
    {{-- Muestra Cada dos categoria OBS: Se duplica este metodo --}}

     
</x-app-layout>