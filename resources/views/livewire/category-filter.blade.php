<?php
$configs = DB::table('configs')->first();

if ($configs != null) {
    $money = DB::table('locations')
        ->where([['id', '=', $configs->location_id]])
        ->value('money');
} else {
    $money = 'USD';
    $dif_precio = 'x%';
}

?>
<div>

    <x-filter-front />

    <div class="bg-white rounded-lg shadow-lg mb-6">
        <div class="px-6 py-2 flex justify-between items-center">
            <h1 class="font-semibold text-gray-700 uppercase mr-4 md:mr-20">{{ $category->name }}</h1>

            <div class="dropdown mr-auto">
                <div class="dropdown__select" style="border-right: 0.5px solid #d7d7d7;border-left: 0.5px solid #d7d7d7">
                    <span class="dropdown__selected">Envio</span>
                    <i class="fa fa-caret-down dropdown__caret"></i>
                </div>
                <ul class="dropdown__list z-30 shadow">

                    @foreach ($shippings as $item)
                        <li class="dropdown__item">
                            <span class="dropdown__selected">
                                <input type="checkbox" {{ $envio == $item->p_tp ? 'checked' : '' }}
                                    wire:click="$set('envio', '{{ $item->p_tp }}')" x-model="envio" name="envio">

                                <a class="cursor-pointer ml-1 hover:text-orange-500 capitalize {{ $envio == $item->p_tp ? 'text-orange-500 font-semibold' : 'text-black' }}"
                                    wire:click="$set('envio', '{{ $item->p_tp }}')">
                                    @switch($item->p_tp)
                                        @case(1)
                                            Local
                                        @break

                                        @case(2)
                                            Local Free
                                        @break

                                        @case(3)
                                            International
                                        @break

                                        @case(4)
                                            International Free
                                        @break

                                        @default
                                    @endswitch
                                    {{-- {{ $item->p_tp }} --}}
                                    ({{ $item->cp_tp }})
                                </a>
                            </span>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="hidden md:block grid grid-cols-2 border border-gray-200 divide-x divide-gray-200 text-gray-500">
                <i class="fas fa-border-all p-3 cursor-pointer {{ $view == 'grid' ? 'text-orange-500' : '' }}"
                    wire:click="$set('view', 'grid')"></i>
                {{-- <i class="fas fa-th-list p-3 cursor-pointer {{ $view == 'list' ? 'text-orange-500' : ''}}" wire:click="$set('view', 'list')"></i> --}}
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">

        <div class="accordion">
            <div class="bg-white rounded-lg shadow-lg px-2 py-2 accordion-item" id="q_filter">
                <a class="accordion-link">
                    <i class="fas fa-angle-down"></i>
                    <i class="fas fa-angle-up"></i>
                    <h1 class="font-bold">Filtro</h1>
                </a>
                <div class="answer card_active" id="card_filter">
                    <p class="p_filter">
                    <aside>

                        @if (count($category->subcategories) != 1)

                            @foreach ($category->subcategories as $subcategory)
                                @if ($subcategory != null)
                                    <h2 class="font-semibold text-center mb-2">Subcategorías</h2>
                                @endif
                            @break
                        @endforeach

                        <ul class="divide-y divide-gray-200">
                            @foreach ($category->subcategories as $subcategory)
                                <li class="py-2 text-sm">

                                    <input type="checkbox"
                                        {{ $subcategoria == $subcategory->slug ? 'checked' : '' }}
                                        wire:click="$set('subcategoria', '{{ $subcategory->slug }}')">

                                    <a class="cursor-pointer ml-1 hover:text-orange-500 capitalize {{ $subcategoria == $subcategory->slug ? 'text-orange-500 font-semibold' : '' }}"
                                        wire:click="$set('subcategoria', '{{ $subcategory->slug }}')">{{ $subcategory->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    <h2 class="font-semibold text-center mt-4 mb-2">Marcas</h2>
                    <ul class="divide-y divide-gray-200">
                        @foreach ($category->brands as $brand)
                            <li class="py-2 text-sm">
                                <a class="cursor-pointer hover:text-orange-500 capitalize {{ $marca == $brand->name ? 'text-orange-500 font-semibold' : '' }}"
                                    wire:click="$set('marca', '{{ $brand->name }}')">
                                    {{ $brand->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>

                    <h2 class="font-semibold text-center mt-4 mb-2">Colors</h2>
                    <ul class="divide-y divide-gray-200" style="max-height: 300px;overflow-y: scroll;">
                        @foreach ($colors as $c)
                            <li class="py-2 text-sm">
                                 <input type="checkbox" {{ $color == $c->c_id ? 'checked' : '' }} 
    wire:click="$set('color', '{{ $c->c_id }}')" value="{{ $c->c_id }}">




                                <a class="cursor-pointer ml-1 hover:text-orange-500 capitalize {{ $color == $c->c_id ? 'text-orange-500 font-semibold' : '' }}"
                                    wire:click="$set('color', '{{ $c->c_id }}')">{{ $c->c_name }}
                                    ({{ $c->cc_name }})
                                </a>
                            </li>
                        @endforeach
                    </ul>

                    <h2 class="font-semibold text-center mt-4 mb-2">{{ __('Strap') }}</h2>
                    <ul class="divide-y divide-gray-200" style="max-height: 300px;overflow-y: scroll;">
                        @foreach ($straps as $strap)
                            <li class="py-2 text-sm">
                                <input type="checkbox" {{ $correa == $strap->bm_id ? 'checked' : '' }} 
    wire:click="$set('correa', '{{ $strap->bm_id }}')" value="{{ $strap->bm_id }}">


                                <a class="cursor-pointer ml-1 hover:text-orange-500 capitalize {{ $correa == $strap->bm_id ? 'text-orange-500 font-semibold' : '' }}"
                                    wire:click="$set('correa', '{{ $strap->bm_id }}')">{{ $strap->bm_name }}
                                    ({{ $strap->cbm_name }})
                                </a>
                            </li>
                        @endforeach

                    </ul>

                    <x-jet-button class="mt-4" wire:click="limpiar">
                        Eliminar filtros
                    </x-jet-button>

                </aside>
                </p>
            </div>
        </div>
    </div>

    <div class="md:col-span-2 lg:col-span-4">
        @if ($view == 'grid')

            <ul class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-2">
                @forelse ($products as $product)
                    <li class="bg-white rounded-lg shadow">
                        <a href="{{ route('products.show', $product) }}">
                            <article>
                                <div class="flex justify-end">
                                    @if ($product->status == '4')
                                        {{-- Agotado --}}
                                        <figure style="position: absolute; margin: 10px 5px;">
                                            <img class="h-5 w-full object-none object-center"
                                                src="{{ asset('img/AGOTADO.png') }}" alt="">
                                        </figure>
                                    @elseif($product->bell_id != null)
                                        <?php
                                        $url = DB::table('bells')
                                            ->where([['id', '=', $product->bell_id]])
                                            ->value('image');
                                        ?>
                                        @if ($url != null)
                                            <figure style="position: absolute;margin: 10px 5px;">
                                                <img class="h-auto w-full object-none object-center"
                                                    src="{{ Storage::url($url) }}" alt="">
                                            </figure>
                                        @endif
                                    @endif

                                    <figure class="flex justify-center">
                                        {{-- <img class="img-figure-p object-cover object-center" src="{{ Storage::url($product->images->first()->url) }}" alt=""> --}}
                                        <img class="img-figure-p object-cover object-center"
                                            src="{{ Storage::url(
                                                DB::table('images')->leftJoin('products', 'products.id', '=', 'images.imageable_id')->orWhere('products.id', $product->id)->where('images.position', 'primary')->value('url'),
                                            ) }}"
                                            alt="">
                                    </figure>
                                </div>
                                <div class="py-4 px-6">
                                    <h1 class="text-lg-p font-semibold text-black">

                                        {{ Str::limit($product->name, 40) }}

                                    </h1>

                                    @if ($product->sub_price != null || $product->sub_price != 0.0)
                                        <div class="flex">
                                            <p class="text-s my-1"
                                                style="text-decoration: line-through rgba(109, 109, 109, 0.767); color:rgba(109, 109, 109, 0.767) ">
                                                {{ $money }} {{ number_format($product->price, 2) }}</p>

                                            <small
                                                class="ml-2 my-2 ">-{{ round(100 - ($product->sub_price * 100.0) / $product->price, 0) }}%</small>
                                        </div>

                                        <p class="text-p  my-1">{{ $money }}
                                            {{ number_format($product->sub_price, 2) }}</p>
                                    @else
                                        <p class="text-p  my-1">{{ $money }}
                                            {{ number_format($product->price, 2) }}</p>
                                    @endif


                                    @if ($product->type_product == 1)
                                        {{-- <p class="text-p  my-1">LOCAL</p> --}}
                                    @elseif($product->type_product == 2)
                                        <div class="flex">
                                            <div style="z-index:10">
                                                <p class="ml-2">
                                                    <x-item_delivery color="#2ECC71" color_line="#ffffff"
                                                        size="25" />
                                                </p>
                                            </div>
                                            <div class="text-item-p">
                                                <p class="ml-3 mt-1 text-item-p"> Envío gratis </p>
                                            </div>
                                        </div>
                                    @elseif($product->type_product == 3)
                                        <div class="flex">
                                            <div style="z-index:10">
                                                <p class="ml-2">
                                                    <x-item_international color="#e46d06" color_line="#ffffff"
                                                        size="25" />
                                                </p>
                                            </div>
                                            <div class="text-item-p">
                                                <p class="ml-3 mt-1 text-item-p"> International </p>
                                            </div>
                                        </div>
                                    @elseif($product->type_product == 4)
                                        <div class="flex">
                                            <div style="z-index:10">
                                                <p class="ml-2">
                                                    <x-item_international color="#e46d06" color_line="#ffffff"
                                                        size="25" />
                                                </p>
                                            </div>
                                            <div class="text-item-p">
                                                <p class="ml-3 mt-1 text-item-p"> International Free</p>
                                            </div>
                                        </div>
                                    @endif

                                    @php
                                        /*Calculo de Reviews*/
                                        $reviews = DB::table('reviews')
                                            ->select(DB::raw('reviews.rating as rating'), DB::raw('reviews.status as status'), DB::raw('DATE_FORMAT(reviews.created_at,"%d %M de %Y %H:%i:%s") as time_review'), DB::raw('reviews.user_id as user_id'), DB::raw('reviews.title as title'), DB::raw('reviews.comment as comment'), DB::raw('reviews.product_id as product_id'), DB::raw('users.name as name'))
                                            ->leftJoin('users', 'users.id', '=', 'reviews.user_id')
                                            ->leftJoin('products', 'products.id', '=', 'reviews.product_id')
                                            ->where('reviews.product_id', $product->id)
                                            ->where('reviews.status', 1)
                                            ->get();
                                        
                                        $sum_rating = 0;
                                        $cont = count($reviews);
                                        
                                        foreach ($reviews as $var) {
                                            if ($var->status == 1) {
                                                $sum_rating += $var->rating;
                                            }
                                        }
                                        
                                        if ($cont != 0) {
                                            $rating = round($sum_rating / $cont, 1);
                                        }
                                        /*Calculo de Reviews*/
                                    @endphp

                                    <div class="flex items-center mt-2">
                                        @if ($cont != 0)
                                            <ul class="flex text-sm">
                                                @foreach (range(1, 5) as $i)
                                                    @if ($rating > 0)
                                                        @if ($rating > 0.5)
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

                                            <span class="text-gray-700 text-sm">({{ $cont }})</span>
                                        @endif
                                    </div>


                                </div>
                            </article>
                        </a>
                    </li>

                @empty
                    <li class="md:col-span-2 lg:col-span-4">
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                            role="alert">
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
            {{ $products->links() }}
        </div>
    </div>

</div>

@push('script')
    <script>
        let i = 0;
        const id_filter = document.getElementById('q_filter');

        id_filter.addEventListener('click', (e) => {
            e.preventDefault();
            if (i == 0) {
                document.getElementById('q_filter').classList.add("active");
                document.getElementById('card_filter').classList.add("card_filter");
                i = 1;
            } else {
                document.getElementById('q_filter').classList.remove("active");
                document.getElementById('card_filter').classList.remove("card_filter");
                i = 0;
            }

        });
    </script>
@endpush

</div>
