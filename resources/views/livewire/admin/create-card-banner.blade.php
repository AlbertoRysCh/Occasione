<div>
    <x-jet-form-section submit="save" class="mb-6">
        <x-slot name="title">
            Crear nueva cardbanner
        </x-slot>

        <x-slot name="description">
            Complete la información necesaria para poder crear una nuevo cardbanner
        </x-slot>

        <x-slot name="form">

            <div class="md:flex col-span-12 sm:col-span-12" style="align-items: center"> 
                <x-jet-label class="px-2">
                    Tipo de Banner
                </x-jet-label>
                <div class="grid grid-cols-2 border border-gray-200 divide-x divide-gray-200 text-gray-500">                   
                    <i class="fas fa-dice-one fa-lg p-3 cursor-pointer {{ $view == 'grid' ? 'text-orange-500' : ''}}" wire:click="$set('view', 'grid')"></i>
                    <i class="fas fa-dice-two fa-lg p-3 cursor-pointer {{ $view == 'list' ? 'text-orange-500' : ''}}" wire:click="$set('view', 'list')"></i>
                </div>
                
                {{-- <div class="ml-auto">
                    <label>
                        <input type="radio" value="1" name="tipo_card" wire:model.defer="createForm.tipo_card">
                        Uno Card Banner
                    </label>
                    
                    <label class="ml-2">
                        <input type="radio" value="0" name="tipo_card" wire:model.defer="createForm.tipo_card">
                        Dos Card Banner
                    </label>
                </div>
                
                <x-jet-input-error for="createForm.tipo_card" /> --}}
            </div>

            <div class="col-span-12 sm:col-span-6">
              

                <div class="col-span-6 px-4 py-4 sm:col-span-4">
                    <x-jet-label>
                        {{__('Heading')}}
                    </x-jet-label>

                    <x-jet-input wire:model="createForm.heading" type="text" class="w-full mt-1" />

                    <x-jet-input-error for="createForm.heading" />
                </div> 
                
                <div class="col-span-6 px-4 py-2 sm:col-span-4">
                    <p>*Recordar de habilitar solo una opción</p>
                </div>

                <div x-data="{ envio_type: @entangle('envio_type') }">
                   
                    {{--  Link Destino  --}}
                    <div class="bg-white rounded-lg shadow">
                        <label class="px-6 py-4 flex items-center cursor-pointer">
                            <input x-model="envio_type"  type="radio" value="1" name="envio_type" class="text-gray-600">
                            <span class="ml-2 text-gray-700">
                                Link destino
                            </span>
        
                        </label>
        
                        <div class="px-6 pb-6 grid grid-cols-2 gap-6 hidden" :class="{ 'hidden': envio_type != 1 }">
         
                            <div class="col-span-1"> 
                                    <x-jet-label value="Url destino" />
                                    <x-jet-input wire:model="createForm.description" type="text" class="w-full m-1" />
                                    <x-jet-input-error for="createForm.description" />
                            </div>    
                            
                        </div>
                    </div>

                    {{--  Link Category  --}}
                    <div class="bg-white rounded-lg shadow">
                        <label class="px-6 py-4 flex items-center cursor-pointer">
                            <input x-model="envio_type"  type="radio" value="2" name="envio_type" class="text-gray-600">
                            <span class="ml-2 text-gray-700">
                                Link Category
                            </span>
        
                        </label>
        
                        <div class="px-6 pb-6 grid grid-cols-2 gap-6 hidden" :class="{ 'hidden': envio_type != 2 }">
         
                            <div class="col-span-1"> 
                                    <x-jet-label value="Categorías" />
                                    
                                    <select class="w-full form-control" wire:model="createForm.link">
                     
                                        <option value="" selected >Seleccione un Category</option>
                
                                        @foreach ($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                   
                                    </select>

                                    <x-jet-input-error for="createForm.link" />
                            </div>    
                            
                        </div>
                    </div>

                      {{--  Link Product  --}}
                     <div class="bg-white rounded-lg shadow">
                        <label class="px-6 py-4 flex items-center cursor-pointer">
                            <input x-model="envio_type"  type="radio" value="3" name="envio_type" class="text-gray-600">
                            <span class="ml-2 text-gray-700">
                                Link Product
                            </span>
        
                        </label>
        
                        <div class="px-6 pb-6 grid grid-cols-2 gap-6 hidden" :class="{ 'hidden': envio_type != 3 }">
         
                            <div class="col-span-1"> 
                                    <x-jet-label value="Products" />
                                    
                                    <select class="w-full form-control" wire:model="createForm.link_name">
                     
                                        <option value="" selected >Seleccione un Products</option>
                
                                        @foreach ($products as $product)
                                            <option value="{{$product->id}}">{{$product->name}}</option>
                                        @endforeach
                                   
                                    </select>

                                    <x-jet-input-error for="createForm.link_name" />
                            </div>    
                            
                        </div>
                    </div>
        
                </div>
           
                <div class="col-span-6 px-4 py-4 sm:col-span-4">
                    <x-jet-label>
                        Imagen Card Banner (1403x325)
                    </x-jet-label>

                    <input wire:model="createForm.image" accept="image/*" type="file" class="mt-1" name="" id="{{$rand}}">
                    <x-jet-input-error for="createForm.image" />
                </div>

                    @if ($view != 'grid')
                        <p>*Rellenar si se selecciona dos card como banner</p>
                        <div class="col-span-6  mt-1 mb-1 sm:col-span-4">
                            <x-jet-label>
                                {{__('Heading')}}
                            </x-jet-label>

                            <x-jet-input wire:model="createForm.s_heading" type="text" class="w-full mt-1" />

                            <x-jet-input-error for="createForm.s_heading" />
                        </div> 

                        
                            <div class="col-span-6 px-4 py-2 sm:col-span-4">
                                <p>*Recordar de habilitar solo una opción</p>
                            </div>

                            <div x-data="{ s_envio_type: @entangle('s_envio_type') }">
                   
                                {{--  Link Destino  --}}
                                <div class="bg-white rounded-lg shadow">
                                    <label class="px-6 py-4 flex items-center cursor-pointer">
                                        <input x-model="s_envio_type"  type="radio" value="1" name="s_envio_type" class="text-gray-600">
                                        <span class="ml-2 text-gray-700">
                                            Link destino
                                        </span>
                    
                                    </label>
                    
                                    <div class="px-6 pb-6 grid grid-cols-2 gap-6 hidden" :class="{ 'hidden': s_envio_type != 1 }">
                     
                                        <div class="col-span-1"> 
                                                <x-jet-label value="Url destino" />
                                                <x-jet-input wire:model="createForm.s_description" type="text" class="w-full mt-1" />
                                                <x-jet-input-error for="createForm.s_description" />
                                        </div>    
                                        
                                    </div>
                                </div>
            
                                {{--  Link Category  --}}
                                <div class="bg-white rounded-lg shadow">
                                    <label class="px-6 py-4 flex items-center cursor-pointer">
                                        <input x-model="s_envio_type"  type="radio" value="2" name="s_envio_type" class="text-gray-600">
                                        <span class="ml-2 text-gray-700">
                                            Link Category
                                        </span>
                    
                                    </label>
                    
                                    <div class="px-6 pb-6 grid grid-cols-2 gap-6 hidden" :class="{ 'hidden': s_envio_type != 2 }">
                     
                                        <div class="col-span-1"> 
                                                <x-jet-label value="Categorías" />
                                                
                                                <select class="w-full form-control" wire:model="createForm.s_link">
                                
                                                    <option value="" selected >Seleccione un Category</option>
                
                                                    @foreach ($categories as $category)
                                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                                    @endforeach
                                            
                                                </select>
                
                                                <x-jet-input-error for="createForm.s_link" />
                                        </div>    
                                        
                                    </div>
                                </div>
            
                                  {{--  Link Product  --}}
                                 <div class="bg-white rounded-lg shadow">
                                    <label class="px-6 py-4 flex items-center cursor-pointer">
                                        <input x-model="s_envio_type"  type="radio" value="3" name="s_envio_type" class="text-gray-600">
                                        <span class="ml-2 text-gray-700">
                                            Link Product
                                        </span>
                    
                                    </label>
                    
                                    <div class="px-6 pb-6 grid grid-cols-2 gap-6 hidden" :class="{ 'hidden': s_envio_type != 3 }">
                     
                                        <div class="col-span-1"> 
                                                <x-jet-label value="Products" />
                                                
                                                <select class="w-full form-control" wire:model="createForm.s_link_name">
                                
                                                    <option value="" selected >Seleccione un Products</option>
                
                                                    @foreach ($products as $product)
                                                        <option value="{{$product->id}}">{{$product->name}}</option>
                                                    @endforeach
                                            
                                                </select>
                
                                                <x-jet-input-error for="createForm.s_link_name" />
                                        </div>    
                                        
                                    </div>
                                </div>
                    
                            </div>
                     

                            <div class="col-span-6 px-4 py-4 sm:col-span-4">
                                <x-jet-label>
                                    Imagen Card Banner 2 (1403x325)
                                </x-jet-label>

                                <input wire:model="createForm.s_image" accept="image/*" type="file" class="mt-1" name="" id="{{$rand}}">
                                <x-jet-input-error for="createForm.s_image" />
                            </div>
            
                    @endif

                    <div class="col-span-6 px-4 py-4 sm:col-span-4">
                        <x-jet-label>
                            Status del Card Banner
                        </x-jet-label>
            
                        <div class="ml-auto">
                            <label>
                                <input type="radio" value="1" name="status" wire:model.defer="createForm.status">
                                Si
                            </label>
                            
                            <label class="ml-2">
                                <input type="radio" value="0" name="status" wire:model.defer="createForm.status">
                                No
                            </label>
                        </div>
                    </div>

            </div>
 
        </x-slot> 

        <x-slot name="actions">

            <x-jet-action-message class="mr-3" on="saved">
                Card Banner creada
            </x-jet-action-message>

            <x-jet-button>
                Agregar
            </x-jet-button>
        </x-slot>
    </x-jet-form-section>

    <x-jet-action-section>
        <x-slot name="title">
            Lista de Card Banner
        </x-slot>

        <x-slot name="description">
            Aquí encontrará todas los Card Banner agregadas
        </x-slot>

        <x-slot name="content">

            <table class="text-gray-600">
                <thead class="border-b border-gray-300">
                    <tr class="text-left">
                        <th class="py-2 w-full">Nombre</th>
                        <th class="py-2">Acción</th>
                    </tr>
                </thead>
 
                <tbody class="divide-y divide-gray-300">
                    @foreach ($card_banners as $cardbanner)
                        <tr>
                            <td class="py-2">
                                <span class="inline-block w-8 text-center mr-2">
                                    {!!$cardbanner->id!!}
                                </span>
                                <div class="col-span-6  mt-1 mb-1 sm:col-span-4">
                                    <a href="{{ Storage::url($cardbanner->image)}}" target="_blank" class="uppercase underline hover:text-blue-600">
                                        {{Str::limit($cardbanner->image, 20)}} 
                                    </a>
                                </div>
                                @if($cardbanner->s_heading != null)
                                    <div class="col-span-6  mt-1 mb-1 sm:col-span-4">
                                        <a href="{{ Storage::url($cardbanner->s_image)}}" target="_blank" class="uppercase underline hover:text-blue-600">
                                            {{Str::limit($cardbanner->s_image, 20)}} 
                                        </a>
                                    </div>
                                @endif
                            </td>
                            <td class="py-2">
                                <div class="flex divide-x divide-gray-300 font-semibold">
                                    <a class="pr-2 hover:text-blue-600 cursor-pointer" wire:click="edit('{{$cardbanner->id}}')">Editar</a>
                                    <a class="pl-2 hover:text-red-600 cursor-pointer" wire:click="$emit('deleteCardbanner', '{{$cardbanner->id}}')">Eliminar</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </x-slot>
    </x-jet-action-section>

    <x-jet-dialog-modal wire:model="editForm.open">

        <x-slot name="title">
            Editar Card Banner
        </x-slot>

        <x-slot name="content">

            <div class="space-y-3">

                <div>
                    @if ($editImage)
                        <img class="w-full h-32 object-cover object-center" src="{{ $editImage->temporaryUrl() }}" alt="">
                    @else
                        <img class="w-full h-32 object-cover object-center" src="{{ Storage::url($editForm['image'])}}" alt="">
                    @endif
                </div>

                <div>  
                    @if($view == 'list') 
                        @if ($s_editImage)
                            <img class="w-full h-32 object-cover object-center" src="{{ $s_editImage->temporaryUrl() }}" alt="">
                        @else
                            <img class="w-full h-32 object-cover object-center" src="{{ Storage::url($editForm['image'])}}" alt="">
                        @endif 
                    @endif 
                </div>

                <div class="col-span-12 sm:col-span-12">
                    <div class="col-span-12 sm:col-span-6">
                    
                        <x-jet-input wire:model="editForm.tipo_card" type="text" class="hidden w-full mt-1" /> 

                        <div>
                            <x-jet-label>
                                Heading (titulo de la img)
                            </x-jet-label> 

                            <x-jet-input wire:model="editForm.heading" type="text" class="w-full mt-1" />

                            <x-jet-input-error for="editForm.heading" />
                        </div> 
                        
                        <div class="col-span-6 px-4 py-2 sm:col-span-4">
                            <p>*Recordar de habilitar solo una opción</p>
                        </div> 

                        <div x-data="{ envio_type_up: @entangle('envio_type_up') }">
                   
                            {{--  Link Destino  --}}
                            <div class="bg-white rounded-lg shadow">
                                <label class="px-6 py-4 flex items-center cursor-pointer">
                                    <input x-model="envio_type_up"  type="radio" value="1" name="envio_type_up" class="text-gray-600">
                                    <span class="ml-2 text-gray-700">
                                        Link destino
                                    </span>
                
                                </label>
                
                                <div class="px-6 pb-6 grid grid-cols-2 gap-6 hidden" :class="{ 'hidden': envio_type_up != 1 }">
                 
                                    <div class="col-span-1"> 
                                            <x-jet-label value="Url destino" />
                                            <x-jet-input wire:model="editForm.description" type="text" class="w-full m-1" />
                                            <x-jet-input-error for="editForm.description" />
                                    </div>    
                                    
                                </div>
                            </div>
        
                            {{--  Link Category  --}}
                            <div class="bg-white rounded-lg shadow">
                                <label class="px-6 py-4 flex items-center cursor-pointer">
                                    <input x-model="envio_type_up"  type="radio" value="2" name="envio_type_up" class="text-gray-600">
                                    <span class="ml-2 text-gray-700">
                                        Link Category
                                    </span>
                
                                </label>
                
                                <div class="px-6 pb-6 grid grid-cols-2 gap-6 hidden" :class="{ 'hidden': envio_type_up != 2 }">
                 
                                    <div class="col-span-1"> 
                                            <x-jet-label value="Categorías" />
                                            
                                            <select class="w-full form-control" wire:model="editForm.link">
                                
                                                <option value="" selected >Seleccione un Category</option>
            
                                                @foreach ($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                        
                                            </select>
            
                                            <x-jet-input-error for="editForm.link" />
                                    </div>    
                                    
                                </div>
                            </div>
        
                              {{--  Link Product  --}}
                             <div class="bg-white rounded-lg shadow">
                                <label class="px-6 py-4 flex items-center cursor-pointer">
                                    <input x-model="envio_type_up"  type="radio" value="3" name="envio_type_up" class="text-gray-600">
                                    <span class="ml-2 text-gray-700">
                                        Link Product
                                    </span>
                
                                </label>
                
                                <div class="px-6 pb-6 grid grid-cols-2 gap-6 hidden" :class="{ 'hidden': envio_type_up != 3 }">
                 
                                    <div class="col-span-1"> 
                                            <x-jet-label value="Products" />
                                            
                                            <select class="w-full form-control" wire:model="editForm.link_name">
                                
                                                <option value="" selected >Seleccione un Products</option>
            
                                                @foreach ($products as $product)
                                                    <option value="{{$product->id}}">{{$product->name}}</option>
                                                @endforeach
                                        
                                            </select>
            
                                            <x-jet-input-error for="editForm.link_name" />
                                    </div>    
                                    
                                </div>
                            </div>
                
                        </div>
              
                        <div>
                            <x-jet-label>
                                Imagen Card Banner (1403x325)
                            </x-jet-label>

                            <input wire:model="editImage" accept="image/*" type="file" class="mt-1" name="" id="{{$rand}}">
                            <x-jet-input-error for="editImage" />
                        </div>

                    </div>
                    @if($view == 'list')
                        <div class="col-span-12 sm:col-span-6 mt-4">
                            <p class="mt-2">2 - Datos del segundo card banner</p>
                            <div>
                                <x-jet-label>
                                    Heading (titulo de la img)
                                </x-jet-label> 

                                <x-jet-input wire:model="editForm.s_heading" type="text" class="w-full mt-1" />

                                <x-jet-input-error for="editForm.s_heading" />
                            </div>    
                            
                            <div class="col-span-6 px-4 py-2 sm:col-span-4">
                                <p>*Recordar de habilitar solo una opción para 2 card</p>
                            </div> 
                                    
                            
                            <div x-data="{ s_envio_type_up: @entangle('s_envio_type_up') }">
                   
                                {{--  Link Destino  --}}
                                <div class="bg-white rounded-lg shadow">
                                    <label class="px-6 py-4 flex items-center cursor-pointer">
                                        <input x-model="s_envio_type_up"  type="radio" value="1" name="s_envio_type_up" class="text-gray-600">
                                        <span class="ml-2 text-gray-700">
                                            Link destino
                                        </span>
                    
                                    </label>
                    
                                    <div class="px-6 pb-6 grid grid-cols-2 gap-6 hidden" :class="{ 'hidden': s_envio_type_up != 1 }">
                     
                                        <div class="col-span-1"> 
                                                <x-jet-label value="Url destino" />
                                                <x-jet-input wire:model="editForm.s_description" type="text" class="w-full mt-1 bg-gray-100" />
                                                <x-jet-input-error for="editForm.s_description" />
                                        </div>    
                                        
                                    </div>
                                </div>
            
                                {{--  Link Category  --}}
                                <div class="bg-white rounded-lg shadow">
                                    <label class="px-6 py-4 flex items-center cursor-pointer">
                                        <input x-model="s_envio_type_up"  type="radio" value="2" name="s_envio_type_up" class="text-gray-600">
                                        <span class="ml-2 text-gray-700">
                                            Link Category
                                        </span>
                    
                                    </label>
                    
                                    <div class="px-6 pb-6 grid grid-cols-2 gap-6 hidden" :class="{ 'hidden': s_envio_type_up != 2 }">
                     
                                        <div class="col-span-1"> 
                                                <x-jet-label value="Categorías" />
                                                
                                                <select class="w-full form-control" wire:model="editForm.s_link">
                                    
                                                    <option value="" selected >Seleccione un Category</option>
            
                                                    @foreach ($categories as $category)
                                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                                    @endforeach
                                            
                                                </select>
            
                                                <x-jet-input-error for="editForm.s_link" />
                                        </div>    
                                        
                                    </div>
                                </div>
            
                                  {{--  Link Product  --}}
                                 <div class="bg-white rounded-lg shadow">
                                    <label class="px-6 py-4 flex items-center cursor-pointer">
                                        <input x-model="s_envio_type_up"  type="radio" value="3" name="s_envio_type_up" class="text-gray-600">
                                        <span class="ml-2 text-gray-700">
                                            Link Product
                                        </span>
                    
                                    </label>
                    
                                    <div class="px-6 pb-6 grid grid-cols-2 gap-6 hidden" :class="{ 'hidden': s_envio_type_up != 3 }">
                     
                                        <div class="col-span-1"> 
                                                <x-jet-label value="Products" />
                                                
                                                <select class="w-full form-control" wire:model="editForm.s_link_name">
                                    
                                                    <option value="" selected >Seleccione un Products</option>
            
                                                    @foreach ($products as $product)
                                                        <option value="{{$product->id}}">{{$product->name}}</option>
                                                    @endforeach
                                            
                                                </select>
            
                                                <x-jet-input-error for="editForm.s_link_name" />
                                        </div>    
                                        
                                    </div>
                                </div>
                    
                            </div>
                                                   
                            <div>
                                <x-jet-label>
                                    Imagen Card Banner 2 (1403x325)
                                </x-jet-label>

                                <input wire:model="s_editImage" accept="image/*" type="file" class="mt-1" name="" id="{{$rand}}">
                                <x-jet-input-error for="s_editImage" />
                            </div>

                        </div>
                    @endif

                    <div class="mt-4">
                        <x-jet-label>
                            Status
                        </x-jet-label>

                        <div class="ml-auto">
                            <label>
                                <input type="radio" value="1" name="status" wire:model.defer="editForm.status">
                                Si
                            </label>
                            
                            <label class="ml-2">
                                <input type="radio" value="0" name="status" wire:model.defer="editForm.status">
                                No
                            </label>
                        </div> 
                    </div>
 
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-danger-button wire:click="update" wire:loading.attr="disabled" wire:target="editImage, update">
                Actualizar
            </x-jet-danger-button>
        </x-slot>

    </x-jet-dialog-modal>
</div>
