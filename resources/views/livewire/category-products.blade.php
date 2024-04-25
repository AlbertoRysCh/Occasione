
<div wire:init="loadPosts">
    @if (count($products))

    <?php
        $configs = DB::table('configs')
        ->first(); 

        if($configs != null) {

                $money =  DB::table('locations')->where([
                        ['id', '=', $configs->location_id],
                        ])->value('money');
            
                // $dif_precio = "";

                // if($product->sub_price != null || $product->sub_price != 0.0){
                //     $dif_precio = (($product->sub_price - $product->price) / $product->sub_price ) * 100.00;
                //     $dif_precio = round($dif_precio, 0); 
                // } 
        }else{
                $money = "USD";
                $dif_precio = "x%";
        }
   
    ?>

    
        <div class="glider-contain">
            <ul class="glider-{{$category->id}} card-pw">
            
                @foreach ($products as $product)
                    <a href="{{ route('products.show', $product) }}">
                        <li class="li-pw bg-white mr-1 ml-1 rounded-lg shadow {{ $loop->last ? '' : 'sm:mr-4' }}">
                            <article>
                                <div class="flex justify-end">
                                    @if($product->status == "4") {{-- Agotado --}}
                                        <figure style="position: absolute; margin: 10px 5px;">
                                            <img class="h-5 w-full object-none object-center" src="{{ asset('img/AGOTADO.png') }}" alt="">
                                        </figure>
                                    @elseif($product->bell_id != null)
                                        <?php 
                                            $url =  DB::table('bells')->where([
                                                ['id', '=', $product->bell_id],
                                                ])->value('image');
                                        ?>
                                        @if($url != null)
                                                <figure style="position: absolute; margin: 10px 5px;">
                                                    <img class="h-auto w-full object-none object-center" src="{{ Storage::url($url) }}" alt="">
                                                </figure>
                                        @endif
                                    @endif

                                    {{-- <figure>
                                        <img class="h-56 w-full object-cover object-center" src="{{ Storage::url($product->images->first()->url) }}" alt="">
                                    </figure> --}}
                                    <figure class="flex justify-center">
                                        {{-- <img class="h-59 w-80 p-4 object-cover object-center" src="{{ Storage::url($product->images->first()->url) }}" alt=""> --}}
                                        <img class="h-59 w-80 p-2 object-cover object-center" src="{{ Storage::url(DB::table('images')
                                        ->leftJoin('products', 'products.id', '=', 'images.imageable_id') 
                                        ->orWhere('products.id', $product->id)
                                        ->where('images.position', 'primary')->value('url')) }}" alt="">
                                    </figure> 

                                </div>
                                
    
                            <div class="py-4 px-6">
                                <h1 class="text-lg-p font-semibold">                                                
                                        {{Str::limit($product->name, 40)}}                                
                                </h1>
    
                                @if($product->sub_price != null || $product->sub_price != 0.0)
                                
                                    <div class="flex">
                                        <p class="text-s my-1"  style="text-decoration: line-through rgba(109, 109, 109, 0.767); color:rgba(109, 109, 109, 0.767) ">{{$money}} {{ number_format($product->price,2) }}</p> 
                                        
                                        <small class="ml-2 my-2 ">-{{round((100-(($product->sub_price *100.00) / $product->price )), 0)}}%</small>
                                        
                                    </div>
                                    <p class="text-p  my-1">{{$money}} {{ number_format($product->sub_price,2) }}</p>
                                
                                @else
                                <p class="text-p  my-1">{{$money}} {{ number_format($product->price,2) }}</p>

                                @endif
                
                                    {{-- <p class="font-bold text-trueGray-700">US$ {{$product->price}}</p> --}}

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
                                        @elseif($product->type_product == 4)
                                            <div class="flex">
                                                <div style="z-index:10"><p class="ml-2"> <x-item_international color="#e46d06" color_line="#ffffff" size="25" /> </p></div>
                                                <div class="text-item-p"><p class="ml-3 mt-1 text-item-p"> International Free</p></div>
                                            </div>
                                        @endif
                            </div>
                            </article>
                        </li> 
                    </a>
                @endforeach
            
            </ul>
        
            <button aria-label="Previous" class="glider-prev">«</button>
            <button aria-label="Next" class="glider-next">»</button>
            <div role="tablist" class="dots"></div>
        </div>

    @else

        <div class="mb-4 h-48 flex justify-center items-center bg-white shadow-xl border border-gray-100 rounded-lg">
            <div class="rounded animate-spin ease duration-300 w-10 h-10 border-2 border-indigo-500"></div>
        </div>
        
    @endif
</div>
