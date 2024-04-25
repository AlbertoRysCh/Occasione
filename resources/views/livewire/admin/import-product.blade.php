<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-gray-700">
     
   
    <h1 class="text-3xl text-center font-semibold mb-8">Complete esta información para crear un producto</h1>
        <div class="col-span-6 sm:col-span-4">
            <div class="">
                <x-jet-label>
                    Subir su document .csv delimitado por comas
                </x-jet-label>

                {{-- <input wire:model="createForm.image" accept="image/*" type="file" class="mt-1" name="" id="{{$rand}}"> --}}
                <input wire:model="createForm.doc"  type="file" class="mt-1" name="">
                <x-jet-input-error for="createForm.doc" />
            
                <div class="flex mt-4">
                    <x-jet-button
                        wire:loading.attr="disabled"
                        wire:target="save"
                        wire:click="save"
                        class="ml-auto">
                        Import
                    </x-jet-button>
                </div>
            </div>
        </div>
</div>
