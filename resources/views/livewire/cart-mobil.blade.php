{{-- <div> 
        <a href="{{ route('shopping-cart') }}" class="py-2 px-4 text-sm flex items-center text-trueGray-500 hover:bg-orange-500 hover:text-white">
     
        <span class="flex justify-center w-9">
            <i class="fas fa-shopping-cart"></i>
        </span>
        <span class="relative inline-block pr-4">
            Carrito de compras
            
            @if (Cart::count())
                <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">{{ Cart::count() }}</span>
            @else
                <span class="absolute top-0 right-0 inline-block w-2 h-2 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full"></span></span>    
            @endif
        </span>
    </a>
</div> --}}

<?php
   $configs = DB::table('configs')
   ->first(); 

   if($configs != null){
   $money =  DB::table('locations')->where([
          ['id', '=', $configs->location_id],
          ])->value('money'); 
    }else{
        $money ="";
    }
?>

<div>
    <x-dropdown-cart-mobil width="96">
        <x-slot name="trigger">
            <span class="relative inline-block cursor-pointer">
            
            @if($configs == null)
                 <x-cart color="#ffffff" size="30" />
            @else 
                 <x-cart color="{{$configs->color_texto_menu}}" size="30" />
            @endif 
               
            @if (Cart::count())
                <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">{{ Cart::count() }}</span>
            @else
                <span class="absolute top-0 right-0 inline-block w-2 h-2 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full"></span></span>    
            @endif
 
            </span>
        </x-slot>

        <x-slot name="content">
  
        </x-slot>
    </x-dropdown-cart-mobil>
</div>

