<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class StatusTipoProduct extends Component
{
    
    public $product, $type_product;

    public function mount(){
        $this->type_product = $this->product->type_product;
    }

    public function save(){
        $this->product->type_product = $this->type_product;
        $this->product->save();

        $this->emit('saved');
    }

    public function render()
    {
        return view('livewire.admin.status-tipo-product');
    }
}
