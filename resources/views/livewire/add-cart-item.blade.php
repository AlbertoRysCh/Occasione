<div x-data>
    @role('admin')
        <p class="text-gray-700 mb-4">
            <span class="font-semibold text-lg">Stock disponible:</span> {{$quantity}}
        </p>
    @endrole

    <div class="flex">
 
        <div class="mr-4">
        
            <x-jet-secondary-button 
                disabled
                x-bind:disabled="$wire.qty <= 1"
                wire:loading.attr="disabled"
                wire:target="decrement"
                wire:click="decrement">
                -
            </x-jet-secondary-button>

            <span class="mx-2 text-gray-700">{{$qty}}</span>

            <x-jet-secondary-button 
                x-bind:disabled="$wire.qty >= $wire.quantity"
                wire:loading.attr="disabled"
                wire:target="increment"
                wire:click="increment">
                +
            </x-jet-secondary-button>
        </div>
 
        <div class="flex-1">
            <x-button color="orange" 
                x-bind:disabled="$wire.qty > $wire.quantity"
                class="w-full btn-cart-p"
                wire:click="addItem"
                wire:loading.attr="disabled"
                wire:target="addItem">
                Añadir al carrito
            </x-button>
        </div>
    </div>

</div>
