 

<div> 

     <x-jet-form-section submit="save" class="mb-6 ">
        <x-slot name="title">
            Crear nueva slider
        </x-slot>

        <x-slot name="description">
            Complete la información necesaria para poder crear una nuevo slider
        </x-slot>
        <x-slot name="form">
        
        <div class="col-span-6 sm:col-span-4">
            
            Crear nueva Config
            <x-jet-label>
                Complete la información necesaria para poder crear una nuevo slider
            </x-jet-label>

        </div>
        
            <div class="col-span-12 sm:col-span-6">
                <x-jet-label>
                    Nombre de Empresa
                </x-jet-label>

                <x-jet-input wire:model="createForm.name" type="text" class="w-full mt-1" />

                <x-jet-input-error for="createForm.name" />
            </div>

             <div class="col-span-6 sm:col-span-3">
                <x-jet-label>
                    CR
                </x-jet-label>

                <x-jet-input wire:model="createForm.cr" type="text" class="w-full mt-1" />

                <x-jet-input-error for="createForm.cr" />
            </div>

             <div class="col-span-6 sm:col-span-3">
                <x-jet-label>
                    Location
                </x-jet-label>

                <x-jet-input wire:model="createForm.location" type="text" class="w-full mt-1" />

                <x-jet-input-error for="createForm.location" />
            </div>

            
             <div class="col-span-6 sm:col-span-4">
                <x-jet-label>
                    Correo
                </x-jet-label>

                <x-jet-input wire:model="createForm.correo" type="text" class="w-full mt-1" />

                <x-jet-input-error for="createForm.correo" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-jet-label>
                    Telefono
                </x-jet-label>

                <x-jet-input wire:model.defer="createForm.telefono" type="text" class="w-full mt-1" />
                <x-jet-input-error for="createForm.telefono" />
            </div>

             <div class="col-span-6 sm:col-span-3">
                <x-jet-label>
                    Link Whats App
                </x-jet-label>

                <x-jet-input wire:model.defer="createForm.url_whats" type="text" class="w-full mt-1" />
                <x-jet-input-error for="createForm.url_whats" />
            </div>

             <div class="col-span-6 sm:col-span-3">
                <x-jet-label>
                    Link Telegram
                </x-jet-label>

                <x-jet-input wire:model.defer="createForm.url_telg" type="text" class="w-full mt-1" />
                <x-jet-input-error for="createForm.url_telg" />
            </div>

            <div class="col-span-6 sm:col-span-3">
                <x-jet-label>
                    Color Text
                </x-jet-label>

                {{-- <x-input wire:model.defer="createForm.color_texto_menu" type="text" class="w-full mt-1" /> --}}
                 <input type="text" class="form-control color-picker" name="createForm.color_texto_menu"   >
                                        
                <x-jet-input-error for="createForm.color_texto_menu" />
            </div>

             <div class="col-span-6 sm:col-span-3">
                <x-jet-label>
                    Color Fondo
                </x-jet-label> 
                  <input type="text" class="w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm color-picker" name="createForm.color_fondo_menu" required >
                
                <x-jet-input-error for="createForm.color_fondo_menu" />
            </div>

             <div class="col-span-6 sm:col-span-3">
                <x-jet-label>
                    Link Instagram
                </x-jet-label>

                <x-jet-input wire:model.defer="createForm.url_instagram" type="text" class="w-full mt-1" />
                <x-jet-input-error for="createForm.url_instagram" />
            </div>

             <div class="col-span-6 sm:col-span-3">
                <x-jet-label>
                    Link Tiktok
                </x-jet-label>

                <x-jet-input wire:model.defer="createForm.url_tiktok" type="text" class="w-full mt-1" />
                <x-jet-input-error for="createForm.url_tiktok" />
            </div>

             <div class="col-span-6 sm:col-span-3">
                <x-jet-label>
                    Link Facebook
                </x-jet-label>

                <x-jet-input wire:model.defer="createForm.url_facebook" type="text" class="w-full mt-1" />
                <x-jet-input-error for="createForm.url_facebook" />
            </div>

            {{-- Pais --}}
           <div class="col-span-6 sm:col-span-4">
                <x-jet-label value="Categorías" />
                <select class="w-full form-control" wire:model="createForm.location_id">
                    <option value="" selected disabled>Seleccione un pais</option>

                    @foreach ($locations as $location)
                        <option value="{{$location->id}}">{{$location->name}}</option>
                    @endforeach
                </select>

                <x-jet-input-error for="createForm.location_id" />
            </div>
 

             <div class="col-span-6 sm:col-span-4">
                <div class="flex">
                    <p>¿La pagina esta en manteniminento?</p>

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
                    Imagen Slider (1403x325)
                </x-jet-label>

                <input wire:model="createForm.image" accept="image/*" type="file" class="mt-1" name="" id="{{$rand}}">
                <x-jet-input-error for="createForm.image" />
            </div>
 
        </x-slot>


        <x-slot name="actions">

            <x-jet-action-message class="mr-3" on="saved">
                Config creada
            </x-jet-action-message>

            <x-jet-button>
                Agregar
            </x-jet-button>
        </x-slot>
    </x-jet-form-section>
 

    <x-action-section>
       

        <x-slot name="content">

            <table class="text-gray-600">
                <thead class="border-b border-gray-300">
                    <tr class="text-left">
                        <th class="py-2 w-full">Nombre</th>
                        <th class="py-2">Acción</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-300">
                    
                </tbody>
            </table>

        </x-slot>
    </x-action-section>
 
    <x-dialog-modal wire:model="editForm.open">
 

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
                        Heading (titulo de la img)
                    </x-jet-label> 

                    <x-jet-input wire:model="editForm.heading" type="text" class="w-full mt-1" />

                    <x-jet-input-error for="editForm.heading" />
                </div>

                <div>
                    <x-jet-label>
                        Description
                    </x-jet-label>
     

                    <x-jet-input wire:model="editForm.description" type="text" class="w-full mt-1 bg-gray-100" />
                    <x-jet-input-error for="editForm.description" />
                </div>

                <div> 
                    <x-jet-label>
                        Link
                    </x-jet-label>
     

                    <x-jet-input wire:model="editForm.link" type="text" class="w-full mt-1 bg-gray-100" />
                    <x-jet-input-error for="editForm.link" />
                </div>

                <div>
                    <x-jet-label>
                        Link Name
                    </x-jet-label>
     

                    <x-jet-input wire:model="editForm.link_name" type="text" class="w-full mt-1 bg-gray-100" />
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
                        Imagen Slider (1403x325)
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

    </x-dialog-modal>

</div>

@push('script')        
 <script>
      $('.color-picker').spectrum({
            type: "text"
          });
 </script>
@endpush

