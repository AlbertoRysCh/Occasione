<div class="bg-white shadow-xl rounded-lg p-6 mb-4">
 
    <p class="text-2xl text-center font-semibold mb-2">Tipo Campaña</p>

    <div class="flex mb-2">
        <select class="w-full form-control" wire:model.defer="bell"> 
            <option value="" selected >Seleccione una Campaña</option>

            @foreach ($bells as $item)
                <option value="{{$item->id}}">{{$item->name}}</option>
            @endforeach 
        </select>
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