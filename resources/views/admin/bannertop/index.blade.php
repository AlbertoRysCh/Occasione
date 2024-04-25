<x-admin-layout> 

    <div class="container py-12">
        <div>

             {{-- Se habilita cuando se haya registrado datos de config --}}
    @if($bannertops != null)
    <section class="bg-white shadow-lg rounded-lg px-12 py-8 mt-6 text-gray-700">
        <form action="{{route('admin.bannertop.save_active')}}" method="POST" enctype="multipart/form-data" class="mb-6 md:grid md:grid-cols-6 md:gap-6">
        @csrf 
         <input type="hidden" name="id" value="{{$bannertops->id}}">
            <div class="col-span-4 sm:col-span-4">
                <div class="flex">
                    <p>¿Habilitar los Banners Top?</p>

                    <div class="ml-auto">
                        @if($bannertops->status == true)
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
    
    {{-- Se habilita cuando se haya registrado datos de config la Opcion de IMG WEB--}}
    @if($bannertops != null)
    <section class="bg-white shadow-lg rounded-lg px-12 py-8 mt-12 text-gray-700">
        <form action="{{route('admin.bannertop.save_img_web')}}" method="POST" enctype="multipart/form-data" class="mb-6 md:grid md:grid-cols-6 md:gap-6">
        @csrf 
            <div class="col-span-6 sm:col-span-4">
            Link del Banner Web: 
                <a href="{{ Storage::url($bannertops->banner_img_web)}}" target="_blank" class="uppercase underline hover:text-blue-600">
                                        {{Str::limit($bannertops->banner_img_web, 20)}} 
                </a>
            </div>

            <input type="hidden" name="id" value="{{$bannertops->id}}">

            <div class="col-span-6 sm:col-span-4">
                <x-jet-label>
                    Imagen Log (256x256)
                </x-jet-label>

                <input  accept="image/*" type="file" class="mt-1" name="logo_web"  >

                <x-jet-input-error for="logo_web" />
            </div>

            
            <div class="col-span-4 sm:col-span-2">
                <x-jet-button>
                    Guardar cambio
                </x-jet-button>
            </div>
        </form>
    </section>
    @endif

        {{-- Se habilita cuando se haya registrado datos de config la Opcion de IMG WEB--}}
        @if($bannertops != null)
        <section class="bg-white shadow-lg rounded-lg px-12 py-8 mt-12 text-gray-700">
            <form action="{{route('admin.bannertop.save_img_app')}}" method="POST" enctype="multipart/form-data" class="mb-6 md:grid md:grid-cols-6 md:gap-6">
            @csrf 
                <div class="col-span-6 sm:col-span-4">
                Link del Banner App: 
                    <a href="{{ Storage::url($bannertops->banner_img_app)}}" target="_blank" class="uppercase underline hover:text-blue-600">
                                            {{Str::limit($bannertops->banner_img_app, 20)}} 
                    </a>
                </div>

                <input type="hidden" name="id" value="{{$bannertops->id}}">

                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label>
                        Imagen Log (256x256)
                    </x-jet-label>

                    <input  accept="image/*" type="file" class="mt-1" name="logo_app"  >

                    <x-jet-input-error for="logo_app" />
                </div>

                
                <div class="col-span-4 sm:col-span-2">
                    <x-jet-button>
                        Guardar cambio
                    </x-jet-button>
                </div>
            </form>
        </section>
    @endif
    <section class="bg-white shadow-lg rounded-lg px-12 py-8 mt-12 text-gray-700">
            <form action="{{route('admin.bannertop.save')}}" method="POST" enctype="multipart/form-data" class="mb-6 md:grid md:grid-cols-6 md:gap-6">
            @csrf 
            @if($bannertops != null)
               <input type="hidden" name="id" value="{{$bannertops->id}}">
            @endif
                <div class="col-span-6 sm:col-span-4">
                    
            {{--Modificar cuando se registra datos de config--}}
                    @if($bannertops == null)
                    Crear nueva Banner
                    @else
                    Update Datos de Banner
                    @endif
                    <x-jet-label>
                    @if($bannertops == null)
                    Complete la información necesaria para poder comenzar con los promos de la web
                    @else
                    Actualiza la información necesaria para poder actualizar los datos de la web
                    @endif 
                    </x-jet-label>

                </div>  
 

                 <div class="col-span-12 sm:col-span-6">
                    <x-jet-label>
                      Link de Banner
                    </x-jet-label>
                    
                @if($bannertops == null)
                    <x-jet-input name="link_banner" type="text" class="w-full mt-1" />
                @else
                    <x-jet-input name="link_banner" type="text" class="w-full mt-1" value="{{$bannertops->link_banner}}"/>
                @endif

                    <x-jet-input-error for="link_banner" />
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <x-jet-label>
                        Dimension Height
                    </x-jet-label>

                @if($bannertops == null)
                    <x-jet-input name="dim_height" type="text" class="w-full mt-1" />
                @else
                    <x-jet-input name="dim_height" type="text" class="w-full mt-1" value="{{$bannertops->dim_height}}"/>
                @endif 

                    <x-jet-input-error for="dim_height" />
                </div>
 
                @if($bannertops == null)
                <div class="col-span-6 sm:col-span-4">
                    <div class="flex">
                        <p>¿Habilitar los Banners Top?</p>

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
             
                @if($bannertops == null)
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label>
                            Imagen Banner Web (1280x43)
                        </x-jet-label>

                        <input  type="file" class="mt-1" name="logo_web"  >
                        <x-jet-input-error for="logo_web" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label>
                            Imagen Banner App (602x64)
                        </x-jet-label>

                        <input  type="file" class="mt-1" name="logo_app"  >
                        <x-jet-input-error for="logo_app" />
                    </div>
                @endif
        
                 
                <x-jet-button>
                    Guardar cambio
                </x-jet-button>
            </form>
    </section>
        </div>
    </div>
 
</x-admin-layout>