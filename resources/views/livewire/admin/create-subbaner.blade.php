<div>
    <x-jet-form-section submit="save" class="mb-6">
        <x-slot name="title">
            Crear nueva Sub Banner
        </x-slot>

        <x-slot name="description">
            Complete la información necesaria para poder crear una nuevo Sub Banner
        </x-slot>

        <x-slot name="form">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label>
                    Name Image
                </x-jet-label>

                <x-jet-input wire:model="createForm.heading" type="text" class="w-full mt-1" />

                <x-jet-input-error for="createForm.heading" />
            </div> 
            
            <div class="col-span-6 sm:col-span-4">
                <p>*Recordar de habilitar solo una opción</p>
            </div>
        {{--  Link URL  --}}
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label>
                    URL Personalizado
                </x-jet-label>

               
                <x-jet-input wire:model="createForm.description" type="text" class="w-full mt-1" />

                <x-jet-input-error for="createForm.description" />
            </div>
              {{--  Link Category  --}}
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label value="Categorías" />
                    <select class="w-full form-control" wire:model="createForm.link">
                     
                        <option value="" selected  >Seleccione un Category</option>

                        @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                   
                    </select>

                    <x-jet-input-error for="createForm.link" />
                </div>
 
            {{--  Link Product  --}}
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label value="Products" />
                    <select class="w-full form-control" wire:model="createForm.link_name">
                     
                        <option value="" selected  >Seleccione un Products</option>

                        @foreach ($products as $product)
                            <option value="{{$product->id}}">{{$product->name}}</option>
                        @endforeach
                   
                    </select>

                    <x-jet-input-error for="createForm.link_name" />
                </div>

            <div class="col-span-6 sm:col-span-4">
                <x-jet-label>
                    Imagen Sub Banner (1403x325)
                </x-jet-label>

                <input wire:model="createForm.image" accept="image/*" type="file" class="mt-1" name="" id="{{$rand}}">
                <x-jet-input-error for="createForm.image" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-jet-label>
                    Status
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

        </x-slot>


        <x-slot name="actions">

            <x-jet-action-message class="mr-3" on="saved">
                Categoría creada
            </x-jet-action-message>

            <x-jet-button>
                Agregar
            </x-jet-button>
        </x-slot>
    </x-jet-form-section>

    <x-jet-action-section>
        <x-slot name="title">
            Lista de Sub Banner
        </x-slot>

        <x-slot name="description">
            Aquí encontrará todas los Sub Banner agregadas
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
                    @foreach ($subbanners as $subbanner)
                        <tr>
                            <td class="py-2">
                                <span class="inline-block w-8 text-center mr-2">
                                    {!!$subbanner->id!!}
                                </span>

                                <a href="{{ Storage::url($subbanner->image)}}" target="_blank" class="uppercase underline hover:text-blue-600">
                                    {{Str::limit($subbanner->image, 20)}} 
                                </a>
                            </td>
                            <td class="py-2">
                                <div class="flex divide-x divide-gray-300 font-semibold">
                                    <a class="pr-2 hover:text-blue-600 cursor-pointer" wire:click="edit('{{$subbanner->id}}')">Editar</a>
                                    <a class="pl-2 hover:text-red-600 cursor-pointer" wire:click="$emit('deleteSubbanner', '{{$subbanner->id}}')">Eliminar</a>
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
            Editar Sub Banner
        </x-slot>

        <x-slot name="content">

            <div class="space-y-3">

                <div>
                    @if ($editImage)
                        <img class="w-full h-64 object-cover object-center" src="{{ Storage::url($editImage->temporaryUrl()) }}" alt="">
                    @else
                        <img class="w-full h-64 object-cover object-center" src="{{ Storage::url($editForm['image'])}}" alt="">
                    @endif
                </div>

                <div>
                    <x-jet-label>
                        Name Image(titulo de la img)
                    </x-jet-label> 

                    <x-jet-input wire:model="editForm.heading" type="text" class="w-full mt-1" />

                    <x-jet-input-error for="editForm.heading" />
                </div>
                
                    <p>*Recordar de habilitar solo una opción</p>
            {{--  Link URL  --}}
                <div>
                    <x-jet-label>
                        URL Personalizado
                    </x-jet-label>
     

                    <x-jet-input wire:model="editForm.description" type="text" class="w-full mt-1 bg-gray-100" />
                    <x-jet-input-error for="editForm.description" />
                </div>

            {{--  Link Category  --}}
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label value="Categorías" />
                    <select class="w-full form-control" wire:model="editForm.link">
                     
                        <option value="" selected >Seleccione un Category</option>

                        @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                   
                    </select>

                    <x-jet-input-error for="editForm.link" />
                </div>
 
            {{--  Link Product  --}}
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label value="Products" />
                    <select class="w-full form-control" wire:model="editForm.link_name">
                     
                        <option value="" selected >Seleccione un Products</option>

                        @foreach ($products as $product)
                            <option value="{{$product->id}}">{{$product->name}}</option>
                        @endforeach
                   
                    </select>

                    <x-jet-input-error for="editForm.link_name" />
                </div>
                 
                <div>
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

                <div>
                    <x-jet-label>
                        Imagen Sub Banner (1403x325)
                    </x-jet-label>

                    <input wire:model="editImage" accept="image/*" type="file" class="mt-1" name="" id="{{$rand}}">
                    <x-jet-input-error for="editImage" />
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
