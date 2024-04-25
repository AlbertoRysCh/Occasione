<x-app-layout>
 
    <div class="container py-4 px-4 container-slider-cardv"> 
        @livewire('show-slider') 
    </div>
     
    <div class="container mt-2 container-slider-cardv"> 
        <section class="mb-6">  
            @livewire('show-sub-banner',['subbanner' => $subbanner])
        </section> 
    </div>
        {{-- Muestra Cada dos categoria OBS: Se duplica este metodo --}}
    <div class="container py-2 container-slider-card">
       
        <section class="mb-6">
            <div class="flex items-center mb-2">
                <h1 class="px-4 text-lg uppercase font-semibold text-gray-700">
                    {{__('Destacado')}}
                </h1>

                {{-- <a href="{{route('categories.show', $categories[$i])}}" class="text-orange-500 hover:text-orange-400 hover:underline ml-2 font-semibold">Ver más</a> --}}

            </div>

            @livewire('products-outstanding')
        </section>

        @for ($i = 0; $i < count($categories); $i++)
            {{-- The current value is {{ $categories[$i]->name }} --}} 
            @if(2 >= $i)
            <section class="mb-6">
                <div class="flex items-center mb-2">
                    <h1 class="px-4 text-lg uppercase font-semibold text-gray-700">
                        {{$categories[$i]->name}}
                    </h1>

                    <a href="{{route('categories.show', $categories[$i])}}" class="text-orange-500 hover:text-orange-400 hover:underline ml-2 font-semibold">Ver más</a>

                </div>

                @livewire('category-products', ['category' => $categories[$i]])
            </section>
            @else
                 
            @endif
        @endfor

        <div class="container container-slider-cardv"> 
            <section class="mt-6 mb-6">  
                @livewire('show-card-banner')
            </section> 
        </div>

        @for ($i = 0; $i < count($categories); $i++)
            {{-- The current value is {{ $categories[$i]->name }} --}} 
            @if(2 < $i && $i < count($categories))
            <section class="mb-6">
                <div class="flex items-center mb-2">
                    <h1 class="px-4 text-lg uppercase font-semibold text-gray-700">
                        {{$categories[$i]->name}}
                    </h1>

                    <a href="{{route('categories.show', $categories[$i])}}" class="text-orange-500 hover:text-orange-400 hover:underline ml-2 font-semibold">Ver más</a>

                </div>

                @livewire('category-products', ['category' => $categories[$i]])
            </section>
            @else
                
            @endif
        @endfor

        {{-- @foreach ($categories as $category)
       
            <section class="mb-6">
                <div class="flex items-center mb-2">
                    <h1 class="text-lg uppercase font-semibold text-gray-700">
                        {{$category->name}}
                    </h1>

                    <a href="{{route('categories.show', $category)}}" class="text-orange-500 hover:text-orange-400 hover:underline ml-2 font-semibold">Ver más</a>

                </div>

                @livewire('category-products', ['category' => $category])
            </section>

        @endforeach --}}

    </div>
    {{-- Muestra Cada dos categoria OBS: Se duplica este metodo --}}
    
    @push('script')
        
        <script>

            Livewire.on('glider', function(id){

                new Glider(document.querySelector('.glider-' + id), {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    draggable: true,
                    dots: '.glider-' + id + '~ .dots',
                    arrows: {
                        prev: '.glider-' + id + '~ .glider-prev',
                        next: '.glider-' + id + '~ .glider-next'
                    },
                    responsive: [
                        {
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

            Livewire.on('glidersb', function(id){

                new Glider(document.querySelector('.glidersb-' + id), {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    draggable: true,
                    dots: '.glidersb-' + id + '~ .dots',
                    arrows: {
                        prev: '.glidersb-' + id + '~ .glider-prev',
                        next: '.glidersb-' + id + '~ .glider-next'
                    },
                    responsive: [
                        {
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

            Livewire.on('gliderout', function(){

                new Glider(document.querySelector('.glider-out'), {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    draggable: true,
                    dots: '.glider-out ~ .dots',
                    arrows: {
                        prev: '.glider-out ~ .glider-prev',
                        next: '.glider-out ~ .glider-next'
                    },
                    responsive: [
                        {
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
            
            Livewire.on('gliderc', function() {

                new Glider(document.querySelector('.glider'), {
                    slidesToShow: 1,
                    dots: '#dots',
                    draggable: true,
                    arrows: {
                        prev: '.glider-prev',
                        next: '.glider-next'
                    }
                });
            }); 

        </script>

    @endpush
    
</x-app-layout>