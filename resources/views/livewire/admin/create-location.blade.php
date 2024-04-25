<div>
    <x-jet-form-section submit="save" class="mb-6">
        <x-slot name="title">
            Crear nueva Location
        </x-slot>

        <x-slot name="description">
            Complete la información necesaria para poder crear una nueva categoría
        </x-slot>

        <x-slot name="form">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label>
                    Name
                </x-jet-label>

                <x-jet-input wire:model="createForm.name" type="text" class="w-full mt-1" />

                <x-jet-input-error for="createForm.name" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-jet-label>
                    Dominio
                </x-jet-label>

                <x-jet-input wire:model="createForm.url_dom" type="text" class="w-full mt-1" />

                <x-jet-input-error for="createForm.url_dom" />
            </div> 

            <div class="col-span-6 sm:col-span-4">
                <x-jet-label>
                    Money
                </x-jet-label>

                <x-jet-input wire:model="createForm.money" type="text" class="w-full mt-1" />

                <x-jet-input-error for="createForm.money" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <div class="flex">
                    <p>¿Está location necesita habilitar?</p>

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

                <x-jet-input-error for="createForm.status" />
            </div>

             <div class="col-span-6 sm:col-span-4">
                <x-jet-label>
                    Imagen Paises (256x256)
                </x-jet-label>

                <input wire:model="createForm.image" accept="image/*" type="file" class="mt-1" name="" id="{{$rand}}">
                <x-jet-input-error for="createForm.image" />
            </div>
  
        </x-slot>


        <x-slot name="actions">

            <x-jet-action-message class="mr-3" on="saved">
                Location creada
            </x-jet-action-message>

            <x-jet-button>
                Agregar
            </x-jet-button>
        </x-slot>
    </x-jet-form-section>

    <x-jet-action-section>
        <x-slot name="title">
            Lista de Paises
        </x-slot>

        <x-slot name="description">
            Aqui encontrara todas los paises agregadas
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
                    @foreach ($locations as $location)
                        <tr>
                            <td class="py-2">
                                <span class="inline-block w-8 text-center mr-2">
                                    {!!$location->id!!}
                                </span>
 
                                <a href="{{ Storage::url($location->img)}}" target="_blank" class="uppercase underline hover:text-blue-600">
                                   {{$location->name}}
                                </a>
                            </td>
                            <td class="py-2">
                                <div class="flex divide-x divide-gray-300 font-semibold">
                                    <a class="pr-2 hover:text-blue-600 cursor-pointer" wire:click="edit('{{$location->id}}')">Editar</a>
                                    <a class="pl-2 hover:text-red-600 cursor-pointer" wire:click="$emit('deleteLocation', '{{$location->id}}')">Eliminar</a>
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
            Editar categoría
        </x-slot>

        <x-slot name="content">

            <div class="space-y-3">
 

                <div>
                    <x-jet-label>
                        Nombre
                    </x-jet-label>

                    <x-jet-input wire:model="editForm.name" type="text" class="w-full mt-1" />

                    <x-jet-input-error for="editForm.name" />
                </div>

                <div>
                    <x-jet-label>
                        Dominio
                    </x-jet-label>

                    <x-jet-input wire:model="editForm.url_dom" type="text" class="w-full mt-1 bg-gray-100" />
                    
                    <x-jet-input-error for="editForm.url_dom" />
                </div>

                <div>
                    <x-jet-label>
                        Money de Pais
                    </x-jet-label>
    
                    <x-jet-input wire:model="editForm.money" type="text" class="w-full mt-1 bg-gray-100" />
    
                    <x-jet-input-error for="editForm.money" />
                </div>
    

                  <div>
                    <div class="flex"> 
                        <x-jet-label>
                            ¿Está location necesita habilitar?
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

                    <x-jet-input-error for="editForm.status" />
                </div>
  
                <div>
                    <x-jet-label>
                        Imagen Paises (256x256)
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
