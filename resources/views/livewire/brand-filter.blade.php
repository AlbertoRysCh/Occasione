<?php
   $configs = DB::table('configs')
   ->first(); 

   if($configs != null) {

        $money =  DB::table('locations')->where([
                ['id', '=', $configs->location_id],
                ])->value('money'); 

   }else{
        $money = "USD";
        $dif_precio = "x%";
   }
   
?>
<div class="container py-8">
   
    {{-- <div class="bg-white rounded-lg shadow-lg mb-6">
        <div class="px-6 py-2 flex justify-between items-center">
            <h1 class="font-semibold text-gray-700 uppercase">{{$category->name}}</h1>

            <div class="hidden md:block grid grid-cols-2 border border-gray-200 divide-x divide-gray-200 text-gray-500">
                <i class="fas fa-border-all p-3 cursor-pointer {{ $view == 'grid' ? 'text-orange-500' : ''}}" wire:click="$set('view', 'grid')"></i>
                <i class="fas fa-th-list p-3 cursor-pointer {{ $view == 'list' ? 'text-orange-500' : ''}}" wire:click="$set('view', 'list')"></i>
            </div>
        </div>
    </div> --}}

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">

        <aside>
            
            
            @foreach ($category as $item)
                @if($item != null)
                    <h2 class="font-semibold text-center mb-2">{{$item->name}}</h2>
                @endif
                @break
            @endforeach
 
            <ul class="divide-y divide-gray-200">
                @foreach ($category as $item)
                    <li class="py-2 text-sm">
                        <a class="cursor-pointer hover:text-orange-500 capitalize {{ $categoria == $item->id ? 'text-orange-500 font-semibold' : '' }}"
                            href="{{ route('categories.show_id',$item->slug)}}"
                        >{{$item->name}}
                        </a>
                    </li>
                @endforeach
            </ul>

            
        </aside>

        <div class="md:col-span-2 lg:col-span-4">
            @if ($view == 'grid')

                <ul class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @forelse ($products as $product)
                        <li class="bg-white rounded-lg shadow">
                            <a href="{{ route('products.show', $product) }}">
                                <article>
                                     
                                        <figure class="flex justify-center">
                                            {{-- <img class="img-figure-p object-cover object-center" src="{{ Storage::url($product->images->first()->url) }}" alt=""> --}}
                                            <img class="img-figure-p object-cover object-center" src="{{ Storage::url(DB::table('images')
                                            ->leftJoin('products', 'products.id', '=', 'images.imageable_id') 
                                            ->orWhere('products.id', $product->id)
                                            ->where('images.position', 'primary')->value('url')) }}" alt="">
                                        </figure> 

                                    <div class="py-4 px-6">
                                            <h1 class="text-lg-p font-semibold">
                                                
                                                    {{Str::limit($product->name, 40)}}
                                            
                                            </h1>

                                            @if($product->sub_price != null || $product->sub_price != 0.0)
                                    
                                                <div class="flex">
                                                    <p class="text-s my-1"  style="text-decoration: line-through rgba(109, 109, 109, 0.767); color:rgba(109, 109, 109, 0.767) ">{{$money}} {{ number_format($product->price,2) }}</p> 
                                                    
                                                    <small class="ml-2 my-2 ">-{{round((100-(($product->sub_price *100.00) / $product->price )), 0)}}%</small>
                                                </div>

                                                <p class="text-p  my-1">{{$money}} {{ number_format($product->sub_price, 2) }}</p>
                                            @else
                                            
                                            <p class="text-p  my-1">{{$money}} {{ number_format($product->price, 2) }}</p>

                                            @endif
                        

                                            @if($product->type_product == 1)
                                            {{-- <p class="text-p  my-1">LOCAL</p> --}}
                                            @elseif($product->type_product == 2)
                                                <div class="flex"> 
                                                    <div style="z-index:10"><p class="ml-2"> <x-item_delivery color="#2ECC71" color_line="#ffffff" size="25" /> </p></div>
                                                    <div class="text-item-p"><p class="ml-3 mt-1 text-item-p"> Envío gratis </p></div>
                                                </div>
                                            @elseif($product->type_product == 3)
                                                <div class="flex">
                                                    <div style="z-index:10"><p class="ml-2"> <x-item_international color="#e46d06" color_line="#ffffff" size="25" /> </p></div>
                                                    <div class="text-item-p"><p class="ml-3 mt-1 text-item-p"> International </p></div>
                                                </div>
                                            @endif

                                            @php
                                                /*Calculo de Reviews*/
                                                $reviews = DB::table('reviews')
                                                    ->select(DB::raw('reviews.rating as rating'),DB::raw('reviews.status as status'), 
                                                    DB::raw('DATE_FORMAT(reviews.created_at,"%d %M de %Y %H:%i:%s") as time_review'),
                                                    DB::raw('reviews.user_id as user_id'),DB::raw('reviews.title as title'),
                                                    DB::raw('reviews.comment as comment'),DB::raw('reviews.product_id as product_id'),
                                                    DB::raw('users.name as name'))
                                                    ->leftJoin('users', 'users.id', '=', 'reviews.user_id')
                                                    ->leftJoin('products', 'products.id', '=', 'reviews.product_id')
                                                    ->where('reviews.product_id',$product->id)
                                                    ->where('reviews.status',1)
                                                    ->get();
                                            
                                                    
                                                $sum_rating = 0; 
                                                $cont=count($reviews); 
                                            
                                                foreach($reviews as $var) {
                                                    if($var->status == 1){
                                                        $sum_rating += $var->rating;  
                                                    }
                                                }
                                            
                                                if($cont != 0){
                                                    $rating = round($sum_rating/$cont,1); 
                                                }
                                                /*Calculo de Reviews*/
                                            @endphp

                                        <div class="flex items-center mt-2">
                                            @if($cont!=0)
                                                <ul class="flex text-sm">
                                                    @foreach(range(1,5) as $i) 
                                                        @if($rating >0)
                                                            @if($rating >0.5)
                                                                <i class="fas fa-star text-yellow-400"></i> 
                                                            @else
                                                                <i class="fas fa-star-half-alt text-yellow-400"></i>
                                                            @endif 
                                                        @else
                                                            <i class="far fa-star text-yellow-400"></i>   
                                                        @endif
                                                        
                                                        @php $rating--; @endphp
                                                    
                                                    @endforeach
                                                
                                                </ul>
                            
                                                <span class="text-gray-700 text-sm">({{$cont}})</span>
                                            @endif
                                        </div>
                                            
                                            
                                    </div>
                                </article>
                            </a>
                        </li>

                    @empty
                        <li class="md:col-span-2 lg:col-span-4">
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                <strong class="font-bold">Upss!</strong>
                                <span class="block sm:inline">No existe ningún producto con ese filtro.</span>
                            </div>
                        </li>
                    @endforelse
                </ul>

            {{-- @else
                <ul>
                    @forelse ($products as $product)
                        
                        <x-product-list :product="$product" />

                    @empty

                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">Upss!</strong>
                            <span class="block sm:inline">No existe ningún producto con ese filtro.</span>
                        </div>

                    @endforelse
                </ul> --}}
            @endif

            <div class="mt-4">
                {{$products->links()}}
            </div>
        </div>

    </div>
</div>
