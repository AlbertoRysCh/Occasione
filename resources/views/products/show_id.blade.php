<?php

use App\Models\Subcategory;
use App\Models\Category;

$configs = DB::table('configs')->first();

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

if ($configs != null) {
    $money = DB::table('locations')
        ->where([['id', '=', $configs->location_id]])
        ->value('money');

    $dif_precio = '';

    if ($product->sub_price != null || $product->sub_price != 0.0) {
        // (100-((precio rebajado *100)/precio normal))
        // $dif_precio = (($product->price - $product->sub_price) / $product->sub_price ) * 10.00;
        $dif_precio = 100 - ($product->sub_price * 100.0) / $product->price;
        $dif_precio = round($dif_precio, 0);
    }
} else {
    $money = 'USD';
    $dif_precio = 'x%';
}

?>

<x-app-layout>

    @push('meta')
        <meta name="{{!!Str::limit($product->description, 40)!!}}" content="{{$product->name}}"/>
    @endpush
    @push('style')
        <style>
            .flex-control-nav li img {
                width: 95px;
                height: 95px;
            }

            .flex-control-nav li {
                width: 20% !important;
            }

            @media (max-width: 1200px) {
                .small_img {
                    margin-left: 10% !important;
                }
            }

            @media (max-width: 1000px) {
                .small_img {
                    margin-left: 2% !important;
                }
            }

            @media (max-width: 800px) {
                .small_img {
                    /* margin-left: 20% !important; */
                    margin-left: 0% !important;
                }

                footer {
                    display: none !important;
                }
            }

            @media (max-width: 600px) {
                .small_img {
                    margin-left: 0% !important;
                }
            }

            @media (max-width: 400px) {
                .small_img {
                    margin-left: 0% !important;
                }

                .flex-control-nav li {
                    width: 25% !important;
                }
            }

        </style>


        <style>
            .span_internacional {
                position: relative;
                list-style: none;
                width: 20px;
                height: 20px;
            }

            .span_internacional .tooltip {
                position: absolute;
                top: 0;
                width: 400px;
                background: #fff;
                padding: 20px;
                box-sizing: border-box;
                border-radius: 4px;
                visibility: hidden;
                opacity: 0;
                transition: .5s;
                transform: translateX(0%) translateY(5%);
            }

            .span_internacional .tooltip:before {
                content: '';
                position: absolute;
                width: 25px;
                height: 25px;
                background: rgb(255, 255, 255);
                top: -10px;
                left: 10px;
                transform: rotate(45deg);
            }

            .span_internacional:hover .tooltip {
                visibility: visible;
                opacity: 1;
                transform: translateX(0%) translateY(25%);
            }

            .span_internacional:hover .tooltip h4 {
                font-style: bold;
            }

            .span_internacional:hover .tooltip ul li {
                list-style: inside;
                font-size: 15px;
            }

            @media (max-width: 400px) {
                .span_internacional .tooltip {
                    left: -7rem;
                    width: 370px;
                }
            }

            @media (max-width: 800px) {
                .span_internacional .tooltip {
                    left: -7rem;
                    width: 370px;
                }
            }

        </style>
    @endpush

    <div class="container py-2 px-4">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-6">
            <div>
                <div class="flexslider slider_img">
                    <ul class="slides">

                        @foreach ($product->images as $image)
                            @if ($image->position == 'primary')
                                <li data-thumb=" {{ Storage::url($image->url) }}" class="zoom-image"
                                    style="height:100%">
                                    <img src=" {{ Storage::url($image->url) }}" class="small_img" />
                                </li>
                            @endif
                        @endforeach

                        @foreach ($product->images as $image)
                            @if ($image->position == 'web')
                                <li data-thumb=" {{ Storage::url($image->url) }}" class="zoom-image"
                                    style="height:100%">
                                    <img src=" {{ Storage::url($image->url) }}" class="small_img" />
                                </li>
                            @endif
                        @endforeach

                        @foreach ($product->images as $image)
                            @if ($image->position == '')
                                {{-- <h1>imgReal</h1> --}}
                                <li data-thumb=" {{ Storage::url($image->url) }}" class="zoom-image"
                                    style="height:100%">
                                    <div class="flex">
                                        <img src=" {{ Storage::url($image->url) }}" class="small_img" />
                                        <figure style="position: absolute; margin: 10px 5px;width: auto">
                                            <img style="height: 30px" class="w-full object-center"
                                                src="{{ asset('img/IMAGEN_REAL.png') }}" alt="">
                                        </figure>
                                    </div>
                                </li>
                            @endif
                        @endforeach

                        @foreach ($product->images as $image)
                            @if ($image->position == 'models')
                                <li data-thumb=" {{ Storage::url($image->url) }}" class="zoom-image"
                                    style="height:100%">
                                    <img src=" {{ Storage::url($image->url) }}" class="small_img" />
                                </li>
                            @endif
                        @endforeach

                        {{-- <img src=" {{Storage::url($product->images[0]->url)}} " class="big_img"/> --}}

                    </ul>
                </div>


                <div class="hidden md:block container py-4 px-4 card_data_p">

                    @if ($product->link_youtube != null || $product->link_youtube != '')
                        <div class="u-s-m-b-30"><iframe src="{!! $product->link_youtube !!}" allowfullscreen></iframe>
                        </div>
                    @endif

                    @livewire('detaill-product', ['product' => $product])

                    <div class="infp content-infp -mt-10 text-gray-700">
                        <div class="detail-infp">
                            <h2 class="font-bold">Descripción</h2>

                            <x-arrow-down size="20" color="#ffffff" />

                        </div>
                        <div class="sub-detail-infp desc">
                            <p> {!! $product->description !!}</p>
                        </div>
                    </div>

                    @livewire('user-review', ['product' => $product])
                </div>

            </div>


            <div class="card_info_p">
                @if ($product->bell_id != null)
                    <?php
                    $url = DB::table('bells')
                        ->where([['id', '=', $product->bell_id]])
                        ->value('image');
                    ?>
                    @if ($url != null)
                        <figure>
                            <img class="h-auto w-auto object-none object-center" src="{{ Storage::url($url) }}"
                                alt="">
                        </figure>
                    @endif
                @endif
                <h1 class="text-tp font-bold text-trueGray-700">{{ $product->name }}</h1>

                <div class="flex">

                    <p class="text-trueGray-700">Marca: <a class="underline capitalize hover:text-orange-500"
                            href="{{ route('brand-filter', $product->brand->name) }}">{{ $product->brand->name }}</a>
                    </p>

                    @if ($cont != 0)
                        <p class="text-trueGray-700 mx-6">
                            {{ $rating }}
                            <i class="fas fa-star text-sm text-yellow-400"></i>
                        </p>
                        <a class="text-orange-500 hover:text-orange-600 underline" href="#reviews">
                            {{-- 39 reseñas --}}
                            {{ $cont }} reseñas
                        </a>
                    @endif

                    @if ($product->type_product == 3 || $product->type_product == 4)
                        <span class="ml-2 span_internacional">
                            <x-international color="#e46d06" size="30" />
                            <div class="tooltip">
                                <h4>Producto con Envío Internacional</h4>
                                <ul>
                                    <li>
                                        Impuestos incluidos. No tendrás cobros extras.
                                    </li>
                                    <li>
                                        Cuenta con garantía de satisfacción.
                                    </li>
                                    <li>
                                        Devoluciones fáciles y gratis.
                                    </li>
                                </ul>
                            </div>
                        </span>
                        {{-- <p class="ml-4">
                            
                            <div class="action_international"><!-- Wrapper -->
                                <div class="icon_international"><!-- Icon facebook -->
                                   <span>
                                        <x-international color="#e46d06" size="30" /> 
                                    </span>
                                    
                                <div class="tooltip"> 
                                        <h4>Producto con Envío Internacional</h4>
                                        <ul>
                                            <li>
                                                Impuestos incluidos. No tendrás cobros extras.
                                            </li>
                                            <li>
                                                Cuenta con garantía de satisfacción.
                                            </li>
                                            <li>
                                                Devoluciones fáciles y gratis.
                                            </li> 
                                        </ul> 
                                </div>
                                </div>
                            </div>
                        </p> --}}
                    @endif

                </div>
                @if ($product->sub_price != null || $product->sub_price != 0.0)
                    <div class="flex">
                        <p class="text-s  my-2"
                            style="text-decoration: line-through rgba(109, 109, 109, 0.767); color:rgba(109, 109, 109, 0.767) ">
                            {{ $money }} {{ number_format($product->price, 2) }}</p>

                        <small class="ml-2 my-3 ">-{{ $dif_precio }}%</small>
                    </div>
                    <div class="flex items-center">
                        <p class="text-p my-2">
                            {{ $money }} {{ number_format($product->sub_price, 2) }}
                            @if ($product->type_product == 2)
                                <span class="ml-2 ">
                                    <div class="flex">
                                        <div style="z-index:10">
                                            <p class="ml-2">
                                                <x-item_delivery color="#2ECC71" color_line="#ffffff" size="25" />
                                            </p>
                                        </div>
                                        <div class="text-item-p">
                                            <p class="ml-3 mt-1 text-item-p"> Envío gratis </p>
                                        </div>
                                    </div>
                                </span>
                            @endif
                        </p>
                    </div>
                @else
                    <div class="flex items-center">
                        <p class="text-p  my-2">
                            {{ $money }} {{ number_format($product->price, 2) }}
                            @if ($product->type_product == 2)
                                <span class="ml-2 ">
                                    <div class="flex">
                                        <div style="z-index:10">
                                            <p class="ml-2">
                                                <x-item_delivery color="#2ECC71" color_line="#ffffff" size="25" />
                                            </p>
                                        </div>
                                        <div class="text-item-p">
                                            <p class="ml-3 mt-1 text-item-p"> Envío gratis </p>
                                        </div>
                                    </div>
                                </span>
                            @endif
                        </p>
                    </div>
                @endif



                @livewire('calculate-direction', ['product' => $product])

                @if ($product->status == '4')
                    {{-- Agotado --}}
                    <figure>
                        <img class="h-10 w-full object-none object-left" src="{{ asset('img/AGOTADO.png') }}" alt="">
                    </figure>
                @endif

                <div class="hidden md:block">
                    @if ($product->subcategory->size)
                        @livewire('add-cart-item-size', ['product' => $product])
                    @elseif($product->subcategory->color)
                        @livewire('add-cart-item-color', ['product' => $product])
                    @else
                        @livewire('add-cart-item', ['product' => $product])
                    @endif
                </div>

                @if ($configs != null)
                    <div class="rounded-lg mb-2">
                        <div class="p-4 flex items-center">

                            <div class="wrapper-whatsapp ">
                                <div class="button-whatsapp" onclick="whatsapp()">
                                    <div class="icon">
                                        <i class="fab fa-whatsapp"></i>
                                    </div>
                                    <span class="vts">Venta por WhatsApp</span>
                                    <span class="info-vts">Atención personalizada</span>
                                </div>
                            </div>

                        </div>
                    </div>
                @endif


            </div>

        </div>


        {{-- Button de carrito de compra --}}
        <div class="md:hidden sm:block bg-white sticky mt-4 -mb-1 bottom-0" style="z-index: 100;">
            <div class="container flex items-center justify-between md:justify-start">

                @if ($product->subcategory->size)
                    @livewire('add-cart-item-size', ['product' => $product])
                @elseif($product->subcategory->color)
                    @livewire('add-cart-item-color', ['product' => $product])
                @else
                    @livewire('add-cart-item', ['product' => $product])
                @endif

            </div>
        </div>

        <div class="md:hidden sm:block container py-4 px-4">


            @livewire('detaill-product', ['product' => $product])

            <div class="infp active content-infp -mt-10 text-gray-700">
                <div class="detail-infp">


                    <h2 class="font-bold">Descripción</h2>

                    <x-arrow-down size="20" color="#ffffff" />

                </div>
                <div class="sub-detail-infp desc">
                    <p> {!! $product->description !!}</p>

                    @if ($product->link_youtube != null || $product->link_youtube != '')
                        <div class="u-s-m-b-30"><iframe src="{!! $product->link_youtube !!}" allowfullscreen></iframe>
                        </div>
                    @endif
                </div>

            </div>

            @livewire('user-review', ['product' => $product])

        </div>
        <?php
        $category_id = Subcategory::where('id', $product->subcategory_id)->value('category_id');
        
        $categories = Category::where('id', $category_id)->get();
        ?>

        <div class="container py-2 container-slider-card">
            <section class="mb-6">
                <div class="flex items-center mb-2">
                    <h1 class="px-4 text-lg uppercase font-semibold text-gray-700">
                        Producto relacionado
                    </h1>

                    {{-- <a href="{{ route('categories.show', $categories[0]) }}"
                    class="text-orange-500 hover:text-orange-400 hover:underline ml-2 font-semibold">Ver más</a> --}}

                </div>

                @livewire('category-products', ['category' => $categories[0]])
            </section>
        </div>

        <section class="modal modal_cart_add_item " style=" background-color: rgb(17 17 17 / 40%);">
            <div class="modal__container" style="display:block;height: auto;">
                <div class="flex added-product ">

                    <h2 class="md:mt-4 highlight w-full">Tu producto se agregó al carrito</h2>

                    <span class="modal__close_cart_item justify-end cursor-pointer">X</span>

                </div>
                <div class="block md:flex">
                    <div class="flex w-full md:w-40 h-30 flex justify-center mb-2 mt-5">

                        <img class="modal__img" style="max-width: 100px !important;"
                            src="{{ Storage::url(
                                DB::table('images')->leftJoin('products', 'products.id', '=', 'images.imageable_id')->orWhere('products.id', $product->id)->where('images.position', 'primary')->value('url'),
                            ) }}"
                            alt="">
                    </div>
                    <div class="m-4">
                        <p class="modal__paragraph">{{ $product->name }}</p>

                        @if ($product->sub_price != null || $product->sub_price != 0.0)
                            <div class="flex">
                                <p class="text-s"
                                    style="text-decoration: line-through rgba(109, 109, 109, 0.767); color:rgba(109, 109, 109, 0.767) ">
                                    {{ $money }} {{ number_format($product->price, 2) }}</p>

                                <small class="ml-2">-{{ $dif_precio }}%</small>
                            </div>
                            <p class="text-p  my-2">{{ $money }}
                                {{ number_format($product->sub_price, 2) }} </p>
                        @else
                            <p class="text-p  my-2">{{ $money }} {{ number_format($product->price, 2) }}
                            </p>
                        @endif

                    </div>
                </div>


                <div class="grid justify-center">
                    <a href="{{ route('shopping-cart') }}" class="modal__close modal_cart justify-center"
                        style="display:flex; color:#fff; padding:0.5em 6rem;">Ir al carrito</a>
                    <a class="modal__close_cart_item_text justify-center pt-2"
                        style="cursor: pointer;color:#f97316;display:flex !important;">Seguir comprando</a>
                </div>
            </div>
        </section>
    </div>


    @push('script')
        <script>
            Livewire.on('glider', function(id) {

                new Glider(document.querySelector('.glider-' + id), {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    draggable: true,
                    dots: '.glider-' + id + '~ .dots',
                    arrows: {
                        prev: '.glider-' + id + '~ .glider-prev',
                        next: '.glider-' + id + '~ .glider-next'
                    },
                    responsive: [{
                            breakpoint: 640,
                            settings: {
                                slidesToShow: 2.5,
                                slidesToScroll: 2,
                            }
                        },
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 3.5,
                                slidesToScroll: 3,
                            }
                        },

                        {
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: 4.5,
                                slidesToScroll: 4,
                            }
                        },

                        {
                            breakpoint: 1280,
                            settings: {
                                slidesToShow: 5.5,
                                slidesToScroll: 5,
                            }
                        },
                    ]
                });

            });
        </script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-zoom/1.7.21/jquery.zoom.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.1/js/bootstrap.min.js"></script>
        <script>
            function whatsapp() {
                let text1 = "<?php echo $product->name; ?>";

                let text2 =
                    text1.replace(/ /g, "%20");

                url = 'https://api.whatsapp.com/send?phone=' + <?php echo $configs->telefono; ?> + '&text=Hola%20necesito%20info%20del%20' +
                    text2 + '%20:D';

                window.open(url, '_blank');
            };
            $(function() {
                $('.zoom-image').each(function() {
                    var originalImagePath = $(this).find('img').data('original-image');
                    $(this).zoom({
                        url: originalImagePath,
                        magnify: 1
                    });
                });
            });

            $(document).ready(function() {
                $('.flexslider').flexslider({
                    animation: "slide",
                    controlNav: "thumbnails"
                });
            });

            const openModal = document.querySelector('.hero__cta');
            const modal_cart_add_item = document.querySelector('.modal_cart_add_item');
            const closeModal_cart_item = document.querySelector('.modal__close_cart_item');
            const closeModal_cart_item_text = document.querySelector('.modal__close_cart_item_text');

            closeModal_cart_item.addEventListener('click', (e) => {
                e.preventDefault();
                modal_cart_add_item.classList.remove('modal--show');
            });
            closeModal_cart_item_text.addEventListener('click', (e) => {
                e.preventDefault();
                modal_cart_add_item.classList.remove('modal--show');
            });

            Livewire.on('add_cart_item', () => {
                setTimeout(function() {
                    modal_cart_add_item.classList.add('modal--show');
                }, 500);
                // setTimeout(function() { 
                //     modal_clains.classList.remove('modal--show');
                // }, 3000); 
            });
            Livewire.on('add_cart_item_color', () => {
                setTimeout(function() {
                    modal_cart_add_item.classList.add('modal--show');
                }, 500);
                // setTimeout(function() { 
                //     modal_clains.classList.remove('modal--show');
                // }, 3000); 
            });
            Livewire.on('add_cart_item_size', () => {
                setTimeout(function() {
                    modal_cart_add_item.classList.add('modal--show');
                }, 500);
                // setTimeout(function() { 
                //     modal_clains.classList.remove('modal--show');
                // }, 3000); 
            });
        </script>
    @endpush
</x-app-layout>
