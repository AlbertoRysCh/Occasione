<?php
   $configs = DB::table('configs')
   ->first(); 
?>
 @if($configs == null)
    <header class="bg-trueGray-700 sticky top-0" style="z-index: 900" x-data="dropdown()">
@else 
    <header class="bg-trueGray-700 sticky top-0" style="z-index: 900;background:{{$configs->color_fondo_menu}}" x-data="dropdown()">
@endif 

    @if($configs != null)
        <style> 
        .enlace-sub{
            background:<?=$configs->color_texto_menu?> !important;
            color:<?=$configs->color_fondo_menu?> !important;
        }


        .categories-link:hover{
            background:<?=$configs->color_fondo_menu?> !important;
            color:<?=$configs->color_texto_menu?> !important;
        } 

        .name-category:hover{
            color:<?=$configs->color_texto_menu?> !important;
        }
        </style>
    @endif


    <div class="container flex items-center h-16 justify-between md:justify-start"> 

        @if($configs == null)
            <a  :class="{'bg-opacity-100 text-orange-500' : open}"
                x-on:click="show()"
                class="flex flex-col items-center justify-center order-last md:order-first px-6 md:px-4 bg-white text-white bg-opacity-25 cursor-pointer font-semibold h-full">
        @else
            <a :class="{'enlace-sub' : open}"  
                x-on:click="show()"
                class="enlace-sub flex flex-col items-center justify-center order-first px-6 md:px-4 bg-white bg-opacity-25 cursor-pointer font-semibold h-full" style="color:{{$configs->color_texto_menu}}">
        @endif            
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16" />
                </svg>

                <span class="text-sm hidden md:block">Categorías</span>
            </a>
            
    
        <!-- Logo -->
                <a class="px-4" href="/">
                    @if($configs == null)
                        <x-jet-application-mark class="block h-9 w-auto" />
                    @else 
                        <img src="{{ Storage::url($configs->logo)}}" width="35" height="35" style="height: {{$configs->tam_img}} !important;"  class="block h-9 w-auto">
                    @endif  
                </a>

            <div class="flex-1 hidden md:block">
                @livewire('search')
            </div>
             

        {{-- Pais --}}
        <div class="hidden md:block md:flex ml-2 contenedor_select" style="z-index:100"> 
			<div class="selectbox">
				<div class="select" id="select" style="margin-left:-15px">
					<div class="contenido-select">
                        @foreach ($locations as $location) 
                        @if($configs->location_id == $location->id)
                                 <img class="img_firts" src="{{ Storage::url($location->img)}}" alt="{{$location->name}}"> 
                        @endif
                         @endforeach
						
					</div>
					<i class="fas fa-angle-down"></i>
				</div>

				<div class="opciones" id="opciones" style="margin-left:-15px">
					 
                    @foreach ($locations as $location)
                       
                           <a href="{{$location->url_dom}}" class="opcion">
                                <div class="contenido-opcion">
                                    <img src="{{ Storage::url($location->img)}}" alt="{{$location->name}}"> 
                                </div>
                            </a> 
                    @endforeach
				 
				</div>
			</div>

			<input type="hidden" name="pais" id="inputSelect" value=""> 

	    </div> 

        <div class="mx-6 relative hidden md:block">
            @auth
            
                <x-jet-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        
                        <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                            <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                        </button>
                    
                    </x-slot>

                    <x-slot name="content">
                        <!-- Account Management -->
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Manage Account') }}
                        </div>

                        <x-jet-dropdown-link href="{{ route('profile.show') }}">
                            {{ __('Profile') }}
                        </x-jet-dropdown-link>

                        <x-jet-dropdown-link href="{{ route('orders.index') }}">
                            {{ __('My Orders') }}
                        </x-jet-dropdown-link>
 

                      
                        @role('admin')
                            <x-jet-dropdown-link href="{{ route('admin.index') }}">
                                Administrador
                            </x-jet-dropdown-link>
                        @endrole

                        <div class="border-t border-gray-100"></div>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-jet-dropdown-link href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                            this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-jet-dropdown-link>
                        </form>
                    </x-slot>
                </x-jet-dropdown>

            @else

                <x-jet-dropdown align="right" width="48">

                    <x-slot name="trigger">
                        <i class="fas fa-user-circle text-white text-3xl cursor-pointer"></i>
                    </x-slot>

                    <x-slot name="content">
                        <x-jet-dropdown-link href="{{ route('login') }}">
                            {{ __('Login / Register') }}
                        </x-jet-dropdown-link>
 
                    </x-slot>

                </x-jet-dropdown>

            @endauth
        </div>

        <div class="hidden md:block">
            @livewire('dropdown-cart')
        </div>
        <div class="block md:hidden">
            @livewire('cart-mobil')
        </div>
    </div>

    <nav id="navigation-menu" 
        :class="{'block': open, 'hidden': !open}"
        class="bg-trueGray-700 bg-opacity-25 w-full absolute hidden">

        {{-- Menu --}}
        <div class="container h-full hidden md:block">
            <div
                x-on:click.away="close()"
                class="grid grid-cols-4 h-full relative">
                <ul class="bg-white">
                    @foreach ($categories as $category)
                        <li class="categories-link navigation-link text-trueGray-500 hover:bg-orange-500 hover:text-white">
                            <a href="{{route('categories.show', $category)}}" class="name-category py-2 px-4 text-sm flex items-center">

                                <span class="flex justify-center w-9">
                                    {!!$category->icon!!}
                                </span>

                                {{$category->name}}
                            </a>


                            <div class="navigation-submenu bg-gray-100 absolute w-3/4 h-full top-0 right-0 hidden">
                                <x-navigation-subcategories :category="$category" />
                            </div>

                        </li>
                    @endforeach
                </ul>

                <div class="col-span-3 bg-gray-100">
                    <x-navigation-subcategories :category="$categories->first()" />
                </div>
            </div>
        </div>

        {{-- menu mobil --}}
        <div class="bg-white h-full overflow-y-auto">

            <div class="container bg-gray-200 py-3 mb-2">
                @livewire('search')
            </div>
 
            <ul>
                @foreach ($categories as $category)
                    <li class="text-trueGray-500 hover:bg-orange-500 hover:text-white">
                        <a href="{{route('categories.show', $category)}}" class="py-2 px-4 text-sm flex items-center">

                            <span class="flex justify-center w-9">
                                {!!$category->icon!!}
                            </span>

                            {{$category->name}}
                        </a>
                    </li>
                @endforeach
            </ul>


            <ul>
              
                    <li class="text-trueGray-500 hover:bg-orange-500 hover:text-white ">
                        <a  class="py-2 px-4 text-sm flex items-center ">

                            <span class="flex justify-center w-9">
                                <i class="fas fa-map-marker-alt"></i>
                            </span>
                            
                            <p class="text-black">Internacional</p>
 
                        </a>
                    </li>
               
            </ul>

            <p class="text-trueGray-500 px-6 my-2">USUARIOS</p>

            {{-- @livewire('cart-mobil') --}}

            @auth
                <a href="{{ route('profile.show') }}" class="py-2 px-4 text-sm flex items-center text-trueGray-500 hover:bg-orange-500 hover:text-white">

                    <span class="flex justify-center w-9">
                        <i class="far fa-address-card"></i>
                    </span>

                    Perfil
                </a>
 
                
                @role('admin') 
                    <a href="{{ route('admin.index') }}" class="py-2 px-4 text-sm flex items-center text-trueGray-500 hover:bg-orange-500 hover:text-white">

                        <span class="flex justify-center w-9">
                            <i class="far fa-address-card"></i>
                        </span>
    
                        Administrador
                    </a>
                @endrole


                <a href="" 
                    onclick="event.preventDefault();
                            document.getElementById('logout-form').submit() "
                    class="py-2 px-4 text-sm flex items-center text-trueGray-500 hover:bg-orange-500 hover:text-white">

                    <span class="flex justify-center w-9">
                        <i class="fas fa-sign-out-alt"></i>
                    </span>

                    Cerrar sesión
                </a>


                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>

            @else
                <a href="{{ route('login') }}" class="py-2 px-4 text-sm flex items-center text-trueGray-500 hover:bg-orange-500 hover:text-white">

                    <span class="flex justify-center w-9">
                        <i class="fas fa-user-circle"></i>
                    </span>

                    {{ __('Login / Register') }}
                </a>

            @endauth
        </div>
    </nav>
</header>