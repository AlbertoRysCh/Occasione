<div>
    <x-jet-form-section submit="save" class="mb-6">
        <x-slot name="title">
            Crear nueva Campaña
        </x-slot>

        <x-slot name="description">
            Complete la información necesaria para poder crear una nuevo campaña
        </x-slot>

        <x-slot name="form">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label>
                    Descripcion de la Campaña
                </x-jet-label>

                <x-jet-input wire:model="createForm.name" type="text" class="w-full mt-1" />

                <x-jet-input-error for="createForm.name" />
            </div>  

            <div class="col-span-6 sm:col-span-4">
                <x-jet-label>
                    Imagen Campaña (75x150px)
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
            Lista de Campaña
        </x-slot>

        <x-slot name="description">
            Aquí encontrará todas los campaña agregadas
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
                    @foreach ($bells as $bell)
                        <tr>
                            <td class="py-2">
                                <span class="inline-block w-8 text-center mr-2">
                                    {!!$bell->id!!}
                                </span>

                                <a href="{{ Storage::url($bell->image)}}" target="_blank" class="uppercase underline hover:text-blue-600">
                                    {{Str::limit($bell->name, 20)}} 
                                </a>
                            </td>
                            <td class="py-2">
                                <div class="flex divide-x divide-gray-300 font-semibold">
                                    <a class="pr-2 hover:text-blue-600 cursor-pointer" wire:click="edit('{{$bell->id}}')">Editar</a>
                                    <a class="pl-2 hover:text-red-600 cursor-pointer" wire:click="$emit('deleteBell', '{{$bell->id}}')">Eliminar</a>
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
            Editar bell
        </x-slot>

        <x-slot name="content">

            <div class="space-y-3">
 
                <div>
                    <img class="w-full h-auto object-none object-center" src="{{ Storage::url($editForm['image'])}}" alt="">
                </div>

                <div>
                    <x-jet-label>
                        Name de Campaña (titulo de la img)
                    </x-jet-label> 

                    <x-jet-input wire:model="editForm.name" type="text" class="w-full mt-1" />

                    <x-jet-input-error for="editForm.name" />
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
                        Imagen Campaña (75x150px)
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
