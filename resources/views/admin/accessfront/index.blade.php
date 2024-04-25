<x-admin-layout>

    <div class="container py-12">
        <div> 
            <section class="bg-white shadow-lg rounded-lg px-12 py-8 mt-12 text-gray-700">
                <form action="{{route('admin.accessfront.save')}}" method="POST" enctype="multipart/form-data" class="mb-6 md:grid md:grid-cols-6 md:gap-6">
                    @csrf 
                    @if($access_fronts != null)
                    <input type="hidden" name="id" value="{{$access_fronts->id}}">
                    @endif
                        <div class="col-span-6 sm:col-span-4">
                            
                    {{--Modificar cuando se registra datos de config--}}
                            @if($access_fronts == null)
                                Crear nueva diseño Access Front
                            @else
                                Update diseño Access Front
                            @endif
                            <x-jet-label>
                            @if($access_fronts == null)
                                Complete la información necesaria para poder comenzar con el diseño Access Front de la web
                            @else
                                Actualiza la información necesaria para poder actualizar los datos para los diseño Access Front
                            @endif 
                            </x-jet-label>

                        </div> 
                         

                        <div class="col-span-4 sm:col-span-4"> 
                            <div class="col-span-6 sm:col-span-3 py-2">
                                <x-jet-label>
                                    Imagen image (256x256)
                                </x-jet-label>
        
                                <input accept="image/*" type="file" class="mt-1" name="image"  >
        
                                <x-jet-input-error for="image" />
                            </div> 
        
                        </div>
                        @if($access_fronts != null)
                            <div class="col-span-4 sm:col-span-2 py-2">
                                Link del image: 
                                <a href="{{ Storage::url( $access_fronts->image )}}" target="_blank" class="uppercase underline hover:text-blue-600">
                                    <img class="w-full h-32 object-contain object-center" src="{{Storage::url( $access_fronts->image )}}" alt="">
                                </a> 
                                
                            </div>
                        @endif

                    {{-- COLOR FONDO --}}
                    <div class="col-span-6 sm:col-span-3">
                        <x-jet-label>
                            Color Fondo
                        </x-jet-label>
                        
                        @if($access_fronts == null)
                            <input type="text" class="w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm color-picker" name="color_fondo_access"  >
                        @else
                            <input type="text" class="w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm color-picker" name="color_fondo_access" value="{{$access_fronts->color_fondo_access}}"/>
                        @endif  
        
                        <x-jet-input-error for="color_fondo_access" />
                    </div> 

                    {{-- COLOR CARD ACCESS --}}
                    <div class="col-span-6 sm:col-span-3">
                        <x-jet-label>
                            Color Card Access
                        </x-jet-label>
                        
                        @if($access_fronts == null)
                            <input type="text" class="w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm color-picker" name="color_card_access"  >
                        @else
                            <input type="text" class="w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm color-picker" name="color_card_access" value="{{$access_fronts->color_card_access}}"/>
                        @endif  
        
                        <x-jet-input-error for="color_card_access" />
                    </div> 
                    
                    {{-- COLOR CARD LINE --}}
                    <div class="col-span-6 sm:col-span-3">
                        <x-jet-label>
                            Color Card Line
                        </x-jet-label>
                        
                        @if($access_fronts == null)
                            <input type="text" class="w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm color-picker" name="color_card_line_access"  >
                        @else
                            <input type="text" class="w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm color-picker" name="color_card_line_access" value="{{$access_fronts->color_card_line_access}}"/>
                        @endif  
        
                        <x-jet-input-error for="color_card_line_access" />
                    </div> 
                    
                    {{-- COLOR HOVER ACCESS --}}
                    <div class="col-span-6 sm:col-span-3">
                        <x-jet-label>
                            Color Hover Access
                        </x-jet-label>
                        
                        @if($access_fronts == null)
                            <input type="text" class="w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm color-picker" name="color_card_hover_access"  >
                        @else
                            <input type="text" class="w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm color-picker" name="color_card_hover_access" value="{{$access_fronts->color_card_hover_access}}"/>
                        @endif  
        
                        <x-jet-input-error for="color_card_hover_access" />
                    </div> 

                    {{-- COLOR HOVER BORDER ACCESS --}}
                    <div class="col-span-6 sm:col-span-3">
                        <x-jet-label>
                            Color Card Border
                        </x-jet-label>
                        
                        @if($access_fronts == null)
                            <input type="text" class="w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm color-picker" name="color_card_border_access"  >
                        @else
                            <input type="text" class="w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm color-picker" name="color_card_border_access" value="{{$access_fronts->color_card_border_access}}"/>
                        @endif  
        
                        <x-jet-input-error for="color_card_border_access" />
                    </div> 
                    
                     {{-- COLOR TEXT HOVER BORDER ACCESS --}}
                     <div class="col-span-6 sm:col-span-3">
                        <x-jet-label>
                            Color Text Hover Border
                        </x-jet-label>
                        
                        @if($access_fronts == null)
                            <input type="text" class="w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm color-picker" name="color_card_text_hover_access"  >
                        @else
                            <input type="text" class="w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm color-picker" name="color_card_text_hover_access" value="{{$access_fronts->color_card_text_hover_access}}"/>
                        @endif  
        
                        <x-jet-input-error for="color_card_text_hover_access" />
                    </div> 
                    
                    {{-- COLOR TEXT ACCESS --}}
                    <div class="col-span-6 sm:col-span-3">
                        <x-jet-label>
                            Color Text Access
                        </x-jet-label>
                        
                        @if($access_fronts == null)
                            <input type="text" class="w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm color-picker" name="color_card_text_access"  >
                        @else
                            <input type="text" class="w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm color-picker" name="color_card_text_access" value="{{$access_fronts->color_card_text_access}}"/>
                        @endif  
        
                        <x-jet-input-error for="color_card_text_access" />
                    </div> 
                    
                    {{-- COLOR ENLACE ACCESS --}}
                    <div class="col-span-6 sm:col-span-3">
                        <x-jet-label>
                            Color Enlace Access
                        </x-jet-label>
                        
                        @if($access_fronts == null)
                            <input type="text" class="w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm color-picker" name="color_card_enlace_access"  >
                        @else
                            <input type="text" class="w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm color-picker" name="color_card_enlace_access" value="{{$access_fronts->color_card_enlace_access}}"/>
                        @endif  
        
                        <x-jet-input-error for="color_card_enlace_access" />
                    </div> 
                      
                        <div class="col-span-6 py-4 sm:col-span-3">
                            <x-jet-button>
                                Guardar cambio
                            </x-jet-button>
                        </div>
                    </form>
            </section>
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