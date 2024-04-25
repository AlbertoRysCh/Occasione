<div class="answer card_active" id="pay_entrega">
    <p class="p_contract">
        Paga al momento de la entrega de tu Pedido.
    </p>
    <x-jet-button
            wire:loading.attr="disabled"
            wire:target="save"
            wire:click="save"
            class="ml-auto" style="width: 80%;justify-content: center;margin: 0 30px; background: #ea580c !important;
            color: #fff !important;">
            Realizar pedido
    </x-jet-button>
</div>