<div class="bg-white shadow-xl rounded-lg p-6 mb-4">
    <p class="text-2xl text-center font-semibold mb-2">Image del producto Principal</p>
 
    @if($position == null)
        <x-form-section-product submit="save" class="mb-6">
        
            <x-slot name="form"> 

                <div class="col-span-12 sm:col-span-6">
                    
                    <div class="col-span-6 px-4 py-4 sm:col-span-4">
                        <x-jet-label>
                            Imagen Principal de producto (1403x325)
                        </x-jet-label>

                        <input wire:model="createForm.image" accept="image/*" type="file" class="mt-1" name="" id="{{$rand}}">
                        <x-jet-input-error for="createForm.image" />
                    </div>
    
                </div>
    
            </x-slot> 

            <x-slot name="actions">

                <x-jet-action-message class="mr-3" on="saved">
                    Imagen principal creada
                </x-jet-action-message>

                <x-jet-button>
                    Agregar
                </x-jet-button>
            </x-slot>
        </x-form-section-product>
    @endif
    @if($position != null)
        <x-action-section-product>
            
            <x-slot name="content">

                
                        @foreach ($product->images as $image)
                            @if($image->position == "primary")
                                                       
                                    <a href="{{ Storage::url($image->url)}}" target="_blank" class="flex justify-center uppercase underline hover:text-blue-600">
                                        <img class="w-auto h-40 object-cover" src="{{ Storage::url($image->url) }}" alt=""> 
                                    </a>
                               
                                    
                                    <div class="flex justify-end items-center">
                                        <a class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition" 
                                        wire:click="edit_primary('{{$image->id}}')">Editar</a>
                                    </div>
                                        
                            @endif 
                        @endforeach
                    
                        
            </x-slot>
        </x-action-section-product>
    @endif
    
    <x-jet-dialog-modal wire:model="editForm.open">

        <x-slot name="title">
            Editar Card Banner
        </x-slot>

        <x-slot name="content">

            <div class="space-y-3">

                <div>
                    @if ($editImage)
                        <img class="w-auto h-40 object-cover object-center" src="{{ $editImage->temporaryUrl() }}" alt="">
                    @else
                        <img class="w-auto h-40 object-cover object-center" src="{{ Storage::url($editForm['image'])}}" alt="">
                    @endif
                </div>
 

                <div class="col-span-12 sm:col-span-12">
                    <div class="col-span-12 sm:col-span-6">
                     
                        <div>
                            <x-jet-label>
                                Imagen Principal de producto  (1403x325)
                            </x-jet-label>

                            <input wire:model="editImage" accept="image/*" type="file" class="mt-1" name="" id="{{$rand}}">
                            <x-jet-input-error for="editImage" />
                        </div>

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