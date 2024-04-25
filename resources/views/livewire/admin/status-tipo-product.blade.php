<div class="bg-white shadow-xl rounded-lg p-6 mb-4">
    <p class="text-2xl text-center font-semibold mb-2">Tipo producto - envío</p>

    <div class="flex mb-2">
        <select class="w-full form-control" wire:model.defer="type_product">
            <option value="" selected disabled>Seleccione el tipo de envio</option>
 
                <option value="1"> ENVIO LOCAL </option> 
                <option value="2"> ENVIO LOCAL GRATIS </option> 
                <option value="3"> ENVIO INTERNATIONAL</option> 
                <option value="4"> ENVIO INTERNATIONAL GRATIS</option> 
        </select>

        {{-- <label class="mr-4">
            <input wire:model.defer="type_product" type="radio" name="type_product" value="1">
            ENVIO LOCAL
        </label>
        <label class="mr-4">
            <input wire:model.defer="type_product" type="radio" name="type_product" value="2">
            ENVIO GRATIS
        </label> 
        <label class="mr-4">
            <input wire:model.defer="type_product" type="radio" name="type_product" value="3">
            ENVIO INTERNATIONAL FREE
        </label> 
        <label class="mr-4">
            <input wire:model.defer="type_product" type="radio" name="type_product" value="4">
            ENVIO INTERNATIONAL
        </label>  --}}
    </div>

    <div class="flex justify-end items-center">

        <x-jet-action-message class="mr-3" on="saved">
            Actualizado
        </x-jet-action-message>

        <x-jet-button wire:click="save"
            wire:loading.attr="disabled"
            wire:target="save">
            Actualizar
        </x-jet-button>
    </div>
</div>