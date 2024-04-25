<x-admin-layout>

    <div class="container py-12">
        <div>
    {{-- Se habilita cuando se haya registrado datos de config --}}
    @if($configs != null)
    <section class="bg-white shadow-lg rounded-lg px-12 py-8 mt-6 text-gray-700">
         <form action="{{route('admin.config.save_active')}}" method="POST" enctype="multipart/form-data" class="mb-6 md:grid md:grid-cols-6 md:gap-6">
            @csrf 
            <input type="hidden" name="id" value="{{$configs->id}}">
                <div class="col-span-4 sm:col-span-4">
                    <div class="flex">
                        <p>¿La pagina esta en mantenimiento?</p>

                        <div class="ml-auto">
                         @if($configs->status == true)
                            <label> 
                                <input type="radio" value="1" checked name="status"  >
                               Si
                            </label>
                            
                            <label class="ml-2">
                                <input type="radio" value="0" name="status"  >
                                No
                            </label>
                        @else
                        <label> 
                                <input type="radio" value="1" name="status"  >
                               Si
                            </label>
                            
                            <label class="ml-2">
                                <input type="radio" value="0" checked name="status"  >
                                No
                            </label>
                        @endif
                        </div>
                    
                    </div>

                    <x-jet-input-error for="status" />

                </div>

                <div class="col-span-4 sm:col-span-2">
                    <x-jet-button>
                        Guardar cambio
                    </x-jet-button>
                </div>
        </form>
    </section>
    @endif
            
    {{-- Se habilita cuando se haya registrado datos de config la Opcion de IMG--}}
    @if($configs != null)
    <section class="bg-white shadow-lg rounded-lg px-12 py-8 mt-12 text-gray-700">
        <form action="{{route('admin.config.save_img')}}" method="POST" enctype="multipart/form-data" class="mb-6 md:grid md:grid-cols-6 md:gap-6">
            @csrf 
                <input type="hidden" name="id" value="{{$configs->id}}">

                <div class="col-span-4 sm:col-span-4"> 
                    <div class="col-span-6 sm:col-span-3 py-2">
                        <x-jet-label>
                            Imagen Log (256x256)
                        </x-jet-label>

                        <input  accept="image/*" type="file" class="mt-1" name="logo"  >

                        <x-jet-input-error for="image" />
                    </div>

                    <div class="col-span-6 sm:col-span-3 py-2">
                        <x-jet-label>
                            Tamaño del logo (Recomendado 2.25 rem)
                        </x-jet-label>

                        <x-jet-input name="tam_img" type="text" class="w-full mt-1" value="{{$configs->tam_img}}"/>
                                                
                        <x-jet-input-error for="tam_img" />
                    </div>

                </div>
                <div class="col-span-4 sm:col-span-2 py-2">
                    Link del Logo: 
                    <a href="{{ Storage::url( $configs->logo )}}" target="_blank" class="uppercase underline hover:text-blue-600">
                        <img class="w-full h-32 object-contain object-center" src="{{Storage::url( $configs->logo )}}" alt="">
                    </a> 
                    
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <x-jet-button>
                        Guardar cambio
                    </x-jet-button>
                </div>
        </form>
    </section>
    @endif


    <section class="bg-white shadow-lg rounded-lg px-12 py-8 mt-12 text-gray-700">
        <form action="{{route('admin.config.save')}}" method="POST" enctype="multipart/form-data" class="mb-6 md:grid md:grid-cols-6 md:gap-6">
            @csrf 
            @if($configs != null)
               <input type="hidden" name="id" value="{{$configs->id}}">
            @endif
                <div class="col-span-6 sm:col-span-4">
                    
            {{--Modificar cuando se registra datos de config--}}
                    @if($configs == null)
                    Crear nueva Config
                    @else
                    Update Config
                    @endif
                    <x-jet-label>
                    @if($configs == null)
                    Complete la información necesaria para poder comenzar con la configuracion de la web
                    @else
                    Actualiza la información necesaria para poder actualizar los datos de la web
                    @endif 
                    </x-jet-label>

                </div>  

                  

                @if($configs == null)
                    <div class="col-span-6 sm:col-span-4">
                        <div class="flex">
                            <p>¿La pagina esta en mantenimiento?</p>

                            <div class="ml-auto">
                                <label>
                                    <input type="radio" value="1" name="status"  >
                                    Si
                                </label>
                                
                                <label class="ml-2">
                                    <input type="radio" value="0" name="status"  >
                                    No
                                </label>
                            </div>
                        
                        </div>

                        <x-jet-input-error for="status" />

                    </div>
                @endif 

                 <div class="col-span-12 sm:col-span-6">
                    <x-jet-label>
                        Nombre de Empresa
                    </x-jet-label>
                    
                @if($configs == null)
                    <x-jet-input name="name" type="text" class="w-full mt-1" />
                @else
                    <x-jet-input name="name" type="text" class="w-full mt-1" value="{{$configs->nombre_empresa}}"/>
                @endif

                    <x-jet-input-error for="name" />
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <x-jet-label>
                        CR
                    </x-jet-label>

                @if($configs == null)
                    <x-jet-input name="cr" type="text" class="w-full mt-1" />
                @else
                    <x-jet-input name="cr" type="text" class="w-full mt-1" value="{{$configs->cr}}"/>
                @endif 

                    <x-jet-input-error for="cr" />
                </div>
                    <div class="col-span-6 sm:col-span-3">
                        <x-jet-label>
                            Location
                        </x-jet-label>

                @if($configs == null)
                    <x-jet-input name="location" type="text" class="w-full mt-1" />
                @else
                    <x-jet-input name="location" type="text" class="w-full mt-1" value="{{$configs->ubicacion}}"/>
                @endif  

                        <x-jet-input-error for="location" />
                    </div>
                    {{-- Pais --}}
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label value="Pais" />
                        <select class="w-full form-control" name="location_id">
                        
                        @if($configs == null)
                            <option value="" selected disabled>Seleccione un pais</option>

                            @foreach ($locations as $location)
                                <option value="{{$location->id}}">{{$location->name}}</option>
                            @endforeach
                        @else 
                            @foreach ($locations as $location)
                                @if($configs->location_id == $location->id)
                                    <option value="{{$location->id}}" selected>{{$location->name}}</option>
                                @else
                                    <option value="{{$location->id}}">{{$location->name}}</option>
                                @endif
                            @endforeach
                        @endif 
                            
                        </select>

                        <x-jet-input-error for="location_id" />
                    </div>

                    
            
             <div class="col-span-6 sm:col-span-3">
                <x-jet-label>
                    Correo
                </x-jet-label>  
                
                @if($configs == null)
                    <x-jet-input name="correo" type="text" class="w-full mt-1" />
                @else
                    <x-jet-input name="correo" type="text" class="w-full mt-1" value="{{$configs->correo}}"/>
                @endif  

                <x-jet-input-error for="correo" />
            </div>

            <div class="col-span-6 sm:col-span-3">
                <x-jet-label>
                    Telefono
                </x-jet-label>

                @if($configs == null)
                    <x-jet-input name="telefono" type="text" class="w-full mt-1" />
                @else
                    <x-jet-input name="telefono" type="text" class="w-full mt-1" value="{{$configs->telefono}}"/>
                @endif  
 
                <x-jet-input-error for="telefono" />
            </div>

             <div class="col-span-6 sm:col-span-3">
                <x-jet-label>
                    Color Text
                </x-jet-label>

                @if($configs == null)
                    <input type="text" class="w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm color-picker" name="color_texto_menu"  >
                @else
                    <input type="text" class="w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm color-picker" name="color_texto_menu" value="{{$configs->color_texto_menu}}"/>
                @endif  
                                        
                <x-jet-input-error for="color_texto_menu" />
            </div>

             <div class="col-span-6 sm:col-span-3">
                <x-jet-label>
                    Color Fondo
                </x-jet-label>
                
                @if($configs == null)
                    <input type="text" class="w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm color-picker" name="color_fondo_menu"  >
                @else
                    <input type="text" class="w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm color-picker" name="color_fondo_menu" value="{{$configs->color_fondo_menu}}"/>
                @endif  
 
                <x-jet-input-error for="color_fondo_menu" />
            </div>

             <div class="col-span-6 sm:col-span-3">
                <x-jet-label>
                    Link Whats App
                </x-jet-label>

                @if($configs == null)
                    <x-jet-input name="url_whats" type="text" class="w-full mt-1" />
                @else
                    <x-jet-input name="url_whats" type="text" class="w-full mt-1" value="{{$configs->link_whatsapp}}"/>
                @endif  
 
                <x-jet-input-error for="url_whats" />
            </div>

             <div class="col-span-6 sm:col-span-3">
                <x-jet-label>
                    Link Telegram
                </x-jet-label>

                @if($configs == null)
                    <x-jet-input name="url_telg" type="text" class="w-full mt-1" />
                @else
                    <x-jet-input name="url_telg" type="text" class="w-full mt-1" value="{{$configs->link_telegram}}"/>
                @endif  
 
                <x-jet-input-error for="url_telg" />
            </div>
        
            <div class="col-span-6 sm:col-span-3">
                <x-jet-label>
                    Link Instagram
                </x-jet-label>
 
                @if($configs == null)
                    <x-jet-input name="url_instagram" type="text" class="w-full mt-1" />
                @else
                    <x-jet-input name="url_instagram" type="text" class="w-full mt-1" value="{{$configs->instagram}}"/>
                @endif  
                 
                <x-jet-input-error for="url_instagram" />
            </div>

             <div class="col-span-6 sm:col-span-3">
                <x-jet-label>
                    Link Tiktok
                </x-jet-label>

                @if($configs == null)
                    <x-jet-input name="url_tiktok" type="text" class="w-full mt-1" />
                @else
                    <x-jet-input name="url_tiktok" type="text" class="w-full mt-1" value="{{$configs->tiktok}}"/>
                @endif 
 
                <x-jet-input-error for="url_tiktok" />
            </div>

             <div class="col-span-6 sm:col-span-3">
                <x-jet-label>
                    Link Facebook
                </x-jet-label>

                @if($configs == null)
                    <x-jet-input name="url_facebook" type="text" class="w-full mt-1" />
                @else
                    <x-jet-input name="url_facebook" type="text" class="w-full mt-1" value="{{$configs->facebook}}"/>
                @endif 
 
                <x-jet-input-error for="url_facebook" />
            </div>
            @if($configs == null)
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label>
                        Imagen Logo (256x256)
                    </x-jet-label>

                    <input  type="file" class="mt-1" name="logo"  >
                    <x-jet-input-error for="logo" />
                </div>
                <div class="col-span-6 py-4 sm:col-span-3">
                    <x-jet-label>
                        Tamaño del logo (Recomendado 2.25 rem)
                    </x-jet-label>
     
                    <input type="text" class="w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm color-picker" name="tam_img"  >
                                               
                    <x-jet-input-error for="tam_img" />
                </div>
            @endif

                @if($configs_footer == null)
                    <div class="col-span-6 sm:col-span-4">

                        <x-jet-label class="py-2">
                            Footer
                        </x-jet-label>

                        <div class="col-span-6 sm:col-span-3">
                            <x-jet-label>
                                Color Fondo
                            </x-jet-label>
            
                            <input type="text" class="w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm color-picker" name="color_footer" />
                                                                            
                            <x-jet-input-error for="color_footer" />
                        
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <x-jet-label>
                                Color Texto
                            </x-jet-label>
            
                            <input type="text" class="w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm color-picker" name="color_texto_footer"/>
                                                                            
                            <x-jet-input-error for="color_texto_footer" />
                        
                        </div>
                    

                        <div class="col-span-6 sm:col-span-3">
                            <x-jet-label>
                                Color Sub Texto
                            </x-jet-label>
            
                            <input type="text" class="w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm color-picker" name="color_subtexto_footer"/>
                                                                            
                            <x-jet-input-error for="color_subtexto_footer" />
                        
                        </div>
                        
                        <div class="col-span-6 sm:col-span-3">
                            <x-jet-label>
                                Color Icons
                            </x-jet-label>
            
                            <input type="text" class="w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm color-picker" name="color_icons_footer"/>
                                                                            
                            <x-jet-input-error for="color_icons_footer" />
                        
                        </div>

                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label>
                                Imagen Footer ()
                            </x-jet-label>

                            <input  type="file" class="mt-1" name="image"  >
                            <x-jet-input-error for="image"/>
                        </div>
                    </div>
                @endif
                <div class="col-span-6 py-4 sm:col-span-3">
                    <x-jet-button>
                        Guardar cambio
                    </x-jet-button>
                </div>
            </form>
    </section>

    
    @if($configs_footer != null)
    <section class="bg-white shadow-lg rounded-lg px-12 py-8 mt-6 text-gray-700">
         <form action="{{route('admin.config.save_footer')}}" method="POST" enctype="multipart/form-data" class="mb-6 md:grid md:grid-cols-6 md:gap-6">
            @csrf 
            <input type="hidden" name="id" value="{{$configs_footer->id}}">
                <div class="col-span-4 sm:col-span-4">
                    <div class="flex">
                        <p>Update Footer</p> 
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <x-jet-label>
                            Color Fondo
                        </x-jet-label>
         
                        <input type="text" class="w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm color-picker" name="color_footer" value="{{$configs_footer->color_footer}}"/>
                                                                           
                        <x-jet-input-error for="color_footer" />
                      
                    </div>

                    <div class="col-span-6 sm:col-span-3 py-2">
                        <x-jet-label>
                            Color Texto
                        </x-jet-label>
         
                        <input type="text" class="w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm color-picker" name="color_texto_footer" value="{{$configs_footer->color_texto_footer}}"/>
                                                                           
                        <x-jet-input-error for="color_texto_footer" />
                      
                    </div>
                

                    <div class="col-span-6 sm:col-span-3 py-2">
                        <x-jet-label>
                            Color Sub Texto
                        </x-jet-label>
         
                        <input type="text" class="w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm color-picker" name="color_subtexto_footer" value="{{$configs_footer->color_subtexto_footer}}"/>
                                                                           
                        <x-jet-input-error for="color_subtexto_footer" />
                      
                    </div>

                    <div class="col-span-6 sm:col-span-3 py-2">
                        <x-jet-label>
                            Color Icons
                        </x-jet-label>
         
                        <input type="text" class="w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm color-picker" name="color_icons_footer" value="{{$configs_footer->color_icons_footer}}"/>
                                                                           
                        <x-jet-input-error for="color_icons_footer" />
                      
                    </div>

                    <div class="col-span-6 sm:col-span-4 py-2">
                        <x-jet-label>
                            Imagen Footer ()
                        </x-jet-label>
    
                        <input  type="file" class="mt-1" name="image"  >
                        <x-jet-input-error for="image" />
                    </div>

                    <x-jet-input-error for="status" />

                </div>

                <div class="col-span-4 sm:col-span-2">
                    Link de Footer Img:
                    <a href="{{ Storage::url( $configs_footer->image )}}" target="_blank" class="uppercase underline hover:text-blue-600">
                        <img class="w-full h-64 object-contain object-center" src="{{Storage::url( $configs_footer->image )}}" alt="">
                    </a> 

                </div>
                
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-button>
                        Guardar cambio
                    </x-jet-button>
                </div>
        </form>
    </section>
    @endif
    
        </div>
    </div>
@push('script')        
 <script>
      $('.color-picker').spectrum({
            type: "text"
          });
 </script>
@endpush
</x-admin-layout>